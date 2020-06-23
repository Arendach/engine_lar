<?php

namespace App\Http\Controllers;

use App\Http\Requests\Orders\CreateBonusRequest;
use App\Http\Requests\Orders\CreateSendingRequest;
use App\Http\Requests\Orders\UpdateAddressRequest;
use App\Http\Requests\Orders\UpdateOrderProfessionalRequest;
use App\Http\Requests\Orders\UpdateProductsRequest;
use App\Http\Requests\Orders\UpdateSelfAddressRequest;
use App\Http\Requests\Orders\UploadFileRequest;
use App\Models\OrderFile;
use App\Services\OrderService;
use Exception;
use App\Http\Requests\Orders\UpdateSendingAddressRequest;
use App\Models\BlackDate;
use App\Orders\OrderUpdate;
use App\Services\CategoryTree;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use SergeyNezbritskiy\PrivatBank\AuthorizedClient;
use SergeyNezbritskiy\PrivatBank\Merchant as MerchantApi;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Logistic;
use App\Models\Order;
use App\Models\OrderHint;
use App\Models\Pay;
use App\Models\Product;
use App\Models\Report;
use App\Models\Shop;
use App\Models\SmsTemplate;
use App\Models\Storage;
use App\Models\User;
use App\Filters\OrdersListFilter;
use App\Http\Requests\Orders\CreateDeliveryRequest;
use App\Http\Requests\Orders\CreateSelfRequest;
use App\Http\Requests\Orders\UpdateCourierRequest;
use App\Http\Requests\Orders\UpdateDeliveryAddressRequest;
use App\Http\Requests\Orders\UpdateContactsRequest;
use App\Http\Requests\Orders\UpdateStatusRequest;
use App\Http\Requests\Orders\UpdateWorkingRequest;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->checkBlackDate();
    }

    private function checkBlackDate()
    {
        if (request()->has('date_delivery') && BlackDate::where('date', request('date_delivery'))->count()) {
            throw new Exception('На цей день заводити замовлення неможна!');
        }
    }

    public function sectionView(OrdersListFilter $filter, Request $request, string $type = 'delivery')
    {
        $orders = Order::with(['pay', 'courier', 'liable', 'bonuses', 'bonuses.user', 'hint', 'professional'])
            ->filter($filter)
            ->paginate(config('app.items'));

        $full = $orders->sum(function ($item) {
            return $item->full_sum;
        });

        $orders->appends($request->all());

        $data = [
            'title'    => "Замовлення :: " . assets('order_types')[$type]['many'],
            'full'     => $full,
            'type'     => $type,
            'orders'   => $orders,
            'couriers' => User::get(),
            'shops'    => Shop::all(),
        ];

        return view('buy.view.index', $data);
    }

    public function sectionCreate(CategoryTree $categoryTree, string $type = 'delivery')
    {
        $data = [
            'categories' => $categoryTree->option(),
            'type'       => $type,
            'hints'      => OrderHint::type($type)->get(),
            'pays'       => Pay::all(),
            'users'      => User::all(),
            'deliveries' => Logistic::all(),
            'storage'    => Storage::where('is_accounted', true)->orderBy('priority')->get()
        ];

        return view('buy.create.main', $data);
    }

    public function sectionUpdate(CategoryTree $categoryTree, int $id)
    {
        $order = Order::findOrFail($id);

        $data = [
            'title'         => 'Замовлення :: Редагування',
            'id'            => $id,
            'type'          => $order->type,
            'order'         => $order,
            'categories'    => $categoryTree->option(),
            'sms_templates' => SmsTemplate::type($order->type)->get(),
            'storage'       => Storage::where('is_accounted', true)->orderBy('priority')->get(),
            'clients'       => Client::all(),
            'closedOrder'   => Report::type('order')->where('data', $id)->count(),
        ];

        if ($order->type == 'sending' && $order->logistic->name == 'НоваПошта') {
            //$data['warehouses'] = NewPostWarehouse::where('city_ref', $order->sending_city->ref)->get();
            $data['warehouses'] = [];
        }

        return view('buy.update.main', $data);
    }

    public function sectionChanges(int $id)
    {
        $order = Order::findOrFail($id);

        $data = [
            'order'       => $order,
            'title'       => 'Історія замовлення',
            'id'          => $id,
            'breadcrumbs' => [
                ['Замовлення', uri('orders/view', ['type' => 'delivery'])],
                [$order->type_name, uri('orders/view', ['type' => $order->type])],
                ['Замовлення #' . $order->id, uri('orders/update', ['id' => $order->id])],
                ['Історія']
            ]
        ];

        $this->view->display('buy.changes.main', $data);
    }

    public function actionDropProduct(OrderUpdate $order, int $pto)
    {
        $order->dropProduct($pto);

        response()->json(['action' => 'close', 'message' => 'Товар вдало видалений!']);
    }

    // Пошук товарів
    public function actionSearchProducts(string $type, $search)
    {
        $builder = Product::limit(50);

        if ($type == 'category') {
            $builder->where('category_id', $search);
        } else {
            $builder->where(function (Builder $builder) use ($search) {
                $builder->where('name_uk', 'like', "%$search%")
                    ->where('name_ru', 'like', "%$search%")
                    ->orWhere('service_code', 'like', "%$search%")
                    ->orWhere('article', 'like', "%$search%")
                    ->orWhere('model_uk', 'like', "%$search%")
                    ->orWhere('name_ru', 'like', "%$search%");
            });
        }

        $result = '';
        foreach ($builder->get() as $product) {
            $result .= "<div data-id='{$product->id}' class='item searched'> ";
            $result .= $product->name;
            $result .= "</div>\n";
        }

        echo $result;
    }

    // Вивод вибраних товарів при пошуку
    public function actionGetProduct(string $type, int $id)
    {
        $result[] = Product::find($id);

        return view('buy.show_found_products', ['products' => $result, 'type' => $type]);
    }

    public function action_change_type($post)
    {
        (new OrderUpdate($post->id))->changeType($post->type);

        response(200, 'Тип замовлення вдало змінений!');
    }

    public function actionPreview(int $id)
    {
        return view('orders.preview', ['order' => Order::findOrFail($id)]);
    }

    public function actionCreateBonus(CreateBonusRequest $request, OrderService $orderService): void
    {
        $orderService->createBonus($request->validated());
    }

    public function action_delete_bonus($post)
    {
        Orders::delete_bonus($post);

        response(200, DATA_SUCCESS_DELETED);
    }

    public function actionUpdateOrderProfessional(UpdateOrderProfessionalRequest $request, OrderService $orderService): void
    {
        $orderService->update($request->get('id'), $request->validated());
    }

    ///////////////////////////////////////////////
    // Роздруковка                               //
    ///////////////////////////////////////////////
    public function section_route_list()
    {
        $ids = explode(':', get('ids'));
        $orders = Orders::findByIDS($ids, 'orders');

        foreach ($orders as $key => $item) {
            $id = $item->id;
            $orders[$id]->sum = Orders::getSum($item);
        }

        $this->view->display('orders.print.route_list', ['orders' => $orders]);
    }

    // Товарний чек
    public function sectionReceipt(int $id, bool $official = false)
    {
        $order = Order::with([
            'products',
            'pay',
            'hint'
        ])->findOrFail($id);

        $data = ['order' => $order];

        /* if ($order->type == 'sending' && $order->street != '') {
             $data['marker'] = app(NewPostService::class)->getMarker($order);
         }*/

        $view = $official ? 'receipt_official' : 'receipt';

        return view("orders.print.$view", $data);
    }

    // Рахунок фактура
    public function sectionInvoice(int $id)
    {
        $order = Orders::getOne(get('id'));

        $pay = Orders::getOne($order->pay_method, 'pays');

        $data = [
            'id'       => get('id'),
            'products' => Orders::getProducts(get('id'))->products,
            'order'    => $order,
            'pay'      => $pay
        ];

        $this->view->display('orders.print.invoice', $data);
    }

    // Роздруковка видаткової накладної
    public function sectionSalesInvoice(int $id)
    {
        $order = Orders::getOne(get('id'));

        $pay = Orders::getOne($order->pay_method, 'pays');

        $data = [
            'id'       => get('id'),
            'products' => Orders::getProducts(get('id'))->products,
            'order'    => $order,
            'pay'      => $pay
        ];

        $this->view->display('orders.print.sales_invoice', $data);
    }


    public function actionCreateDelivery(CreateDeliveryRequest $request, OrderService $orderService): JsonResponse
    {
        return $this->createOrder($request, $orderService);
    }

    public function actionCreateSelf(CreateSelfRequest $request, OrderService $orderService): JsonResponse
    {
        return $this->createOrder($request, $orderService);
    }

    public function actionCreateSending(CreateSendingRequest $request, OrderService $orderService): JsonResponse
    {
        return $this->createOrder($request, $orderService);
    }

    private function createOrder($request, $orderService): JsonResponse
    {
        $id = $orderService->create($request->validated());

        return response()->json([
            'url' => uri('orders/update', ['id' => $id])
        ]);
    }


    // Оновлення контактної інформації
    public function actionUpdateContacts(UpdateContactsRequest $request, OrderService $orderService)
    {
        $orderService->update($request->id, $request->validated());
    }

    // Оновлення службової інформації
    public function actionUpdateWorking(UpdateWorkingRequest $request, OrderService $orderService): void
    {
        $orderService->update($request->get('id'), $request->validated());
    }

    // Оновлення адреси
    public function actionUpdateAddress(UpdateAddressRequest $request, OrderService $orderService): void
    {
        $orderService->updateAddress($request->get('id'), $request->validated());
    }

    // Оновлення інформаціїї про оплату
    public function action_update_pay($post)
    {

    }

    // Оновлення товарів
    public function actionUpdateProducts(UpdateProductsRequest $request, OrderService $service)
    {
        $service->updateProducts($request->get('id'), $request->validated());
    }

    public function actionCloseForm(int $id)
    {
        $order = Order::findOrFail($id);

        $this->view->display('buy.update.close_form', [
            'order' => $order,
            'title' => 'Закрити замовлення'
        ]);
    }

    public function actionClose(Request $request, OrderUpdate $orderUpdate)
    {
        if (Report::where('data', $request->id)->where('type', 'order')->count()) {
            Reports::createOrder($request->toArray());

            $orderUpdate->status(4);
        }

        response()->json([
            'message' => 'Замовлення вдало закрито!'
        ]);

    }

    public function actionUpdateStatus(UpdateStatusRequest $request, OrderUpdate $orderUpdate)
    {
        $orderUpdate->status($request->status);

        response()->json([
            'message' => 'Статус вдало оновлено!',
            'action'  => 'close'
        ]);
    }

    public function actionUpdateCourier(UpdateCourierRequest $request, OrderUpdate $order)
    {
        $order->courier($request->toCollection());

        response()->json(['message' => 'Курєр успішно змінений!']);
    }

    public function action_export($post)
    {
        if (!isset($post->ids) || empty($post->ids))
            response(400, 'Виберіть хоча б одне замовлення!');

        $success = 0;
        foreach ($post->ids as $id) {
            $success += Orders::export($id);
        }

        $count = my_count($post->ids);

        $response = "Вдало проекспортовано $success з $count замовлень!";

        if ($success < $count)
            $response .= '<br><a target="_blank" href="' . uri('log', ['section' => 'new_post']) . '">Переглянути логи!</a>';

        response(200, $response);
    }

    public function section_new_post_logs()
    {
        $content = file_get_contents(ROOT . '/server/logs/new_post.txt');

        $arr = explode(PHP_EOL, $content);

        foreach ($arr as $i => $item) {
            $arr[$i] = json_decode($item);
        }

        $data = [
            'title' => 'Логи помилок Нової пошти',
            'logs'  => $arr
        ];

        $this->view->display('orders.new_post_logs', $data);
    }

    public function actionUploadFile(UploadFileRequest $request)
    {
        foreach ($request->file as $file) {
            $newName = rand32() . '.' . mb_strtolower($file->getClientOriginalExtension());
            $path = storage_path("app/public/orders/{$request->id}/");

            if (!is_dir($path)) {
                mkdir($path);
            }

            $file->move($path, $newName);

            OrderFile::create([
                'path'     => "/storage/orders/{$request->id}/{$newName}",
                'name'     => $file->getClientOriginalName(),
                'user_id'  => user()->id,
                'order_id' => $request->id
            ]);
        }
    }

    public function action_delete_image($post)
    {
        $bean = R::load('order_images', $post->id);

        unlink(ROOT . $bean->path);

        R::trash($bean);

        response(200, DATA_SUCCESS_DELETED);
    }

    public function action_search_clients($post)
    {
        $str = '';

        $result = Orders::search_clients($post);
        foreach ($result as $item) {
            $str .= '<div data-phone="' . $item->phone . '" data-value="' . $item->id . '" class="client">' . $item->name . '</div>';
        }
        echo $str;
    }

    public function action_search_transaction($post)
    {
        $start = date('d.m.Y', time() - 60 * 60 * 24 * 30);
        $finish = date('d.m.Y');

        $order = Orders::getOne($post->id);
        $pay_method = Orders::getOne($order->pay_method, 'pays');
        $merchant_db = Orders::getOne($pay_method->merchant_id, 'merchant');
        $merchant_cards = Orders::findAll('merchant_card', 'merchant_id = ?', [$merchant_db->id]);

        // Авторизація клієнта
        $client = new AuthorizedClient();

        // Авторизація мерчанта
        $merchant = new MerchantApi($merchant_db->merchant_id, $merchant_db->password);

        $client->setMerchant($merchant);

        $temp = [];
        foreach ($merchant_cards as $card) {
            // запит на виписку по карті
            $result = $client->statements($card->number, $start, $finish);

            foreach ($result as $item) {
                // залишаємо тільки прибутки
                if ($item['cardamount'] > 0) {
                    if (!Orders::count('order_transaction', 'transaction_id = ?', [$item['appcode']]))
                        $temp[] = $item;
                }
            }
        }

        $data = [
            'title'        => 'Додати транзакцію',
            'transactions' => $temp,
            'order_id'     => $post->id,
            'modal_size'   => 'lg'
        ];

        $this->view->display('buy.update.parts.transaction_add', $data);
    }

    public function action_add_transaction($post)
    {
        $temp = [];
        foreach ($post->transactions as $k => $item) {
            parse_str($item, $temp[$k]);

            Orders::insert($temp[$k], 'order_transaction');
        }

        response(200, 'Транзакції вдало привязані!');
    }

    public function action_delete_transaction($post)
    {
        Orders::delete($post->id, 'order_transaction');

        response(200, 'Транзакція вдало видалена!');
    }

    public function actionViewAutoComplete(string $search, string $field, string $type)
    {
        $response = Order::where($field, 'like', "%$search%")
            ->where('type', $type)
            ->limit(5)
            ->get()
            ->pluck('fio')
            ->toArray();

        response()->json($response);
    }
}