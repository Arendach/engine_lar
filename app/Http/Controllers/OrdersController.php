<?php

namespace App\Http\Controllers;

use App\Http\Requests\Orders\UpdateSendingAddressRequest;
use App\Models\NewPostCity;
use App\Models\NewPostWarehouse;
use App\Orders\OrderUpdate;
use App\Services\CategoryTree;
use Illuminate\Database\Eloquent\Builder;
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
use App\Requests\Orders\CreateDeliveryRequest;
use App\Requests\Orders\CreateSelfRequest;
use App\Requests\Orders\UpdateCourierRequest;
use App\Requests\Orders\UpdateDeliveryAddressRequest;
use App\Requests\Orders\UpdateContactsRequest;
use App\Requests\Orders\UpdateStatusRequest;
use App\Requests\Orders\UpdateWorkingRequest;
use App\Services\NewPost;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->checkBlackDate();
    }

    private function checkBlackDate()
    {
        if (!request('date_delivery'))
            return;

        $filepath = ROOT . '/server/black_dates.txt';

        if (!file_exists($filepath))
            file_put_contents($filepath, null);

        $filecontent = file_get_contents($filepath);

        if (mb_strlen($filecontent) < 5) return;

        $black_dates = explode(',', $filecontent);

        $black_dates = array_map('trim', $black_dates);

        if (in_array(trim(request('date_delivery')), $black_dates))
            response(400, 'На цю дату неможливо завести замовлення!');
    }

    public function sectionView(OrdersListFilter $filter, Request $request, string $type = 'delivery')
    {
        $orders = Order::with(['pay', 'courier', 'liable', 'bonuses', 'bonuses', 'hint', 'professional'])
            ->filter($filter)
            ->paginate(config('app.items'));

        $full = $orders->sum(function ($item) {
            return $item->full_sum;
        });

        $orders->appends($request->all());

        $data = [
            'title'       => "Замовлення :: " . assets('order_types')[$type]['many'],
            'full'        => $full,
            'type'        => $type,
            'orders'      => $orders,
            'couriers'    => User::where('archive', 0)->get(),
            'shops'       => Shop::all(),
            'request'     => $request,
            'breadcrumbs' => [
                ['Замовлення', uri('orders/view', ['type' => 'delivery'])],
                [assets('order_types')[$type]['many']]
            ]
        ];

        return view('buy.view.index', $data);
    }

    public function sectionCreate(CategoryTree $categoryTree, string $type = 'delivery')
    {
        $data = [
            'title'      => 'Замовлення :: Нове замовлення',
            'categories' => $categoryTree->get(),
            'type'       => $type,
            'hints'      => OrderHint::type($type)->get(),
            'pays'       => Pay::all(),
            'users'      => User::all(),
            'deliveries' => Logistic::all(),
            'storage'    => Storage::accounted()->sort()->get()
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
            'categories'    => $categoryTree->get(),
            'sms_templates' => SmsTemplate::type($order->type)->get(),
            'storage'       => Storage::accounted()->sort()->get(),
            'clients'       => Client::all(),
            'closedOrder'   => Report::type('order')->where('data', $id)->count(),
        ];

        if ($order->type == 'sending' && $order->logistic->name == 'НоваПошта') {
            $data['warehouses'] = NewPostWarehouse::where('city_ref', $order->sending_city->ref)->get();
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

        if ($type == 'category') $builder->where('category', $search);
        else
            $builder->where(function (Builder $builder) use ($search) {
                $builder->where('name', 'like', "%$search%")
                    ->orWhere('services_code', 'like', "%$search%")
                    ->orWhere('articul', 'like', "%$search%")
                    ->orWhere('model', 'like', "%$search%")
                    ->orWhere('name_ru', 'like', "%$search%");
            });

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

        $this->view->display('buy.show_found_products', ['products' => $result, 'type' => $type]);
    }

    public function action_change_type($post)
    {
        (new OrderUpdate($post->id))->changeType($post->type);

        response(200, 'Тип замовлення вдало змінений!');
    }

    public function actionPreview(int $id)
    {
        $this->view->display('orders.preview', ['order' => Order::findOrFail($id)]);
    }

    public function action_create_user_bonus($post)
    {
        if ($post->sum <= 0)
            response('Сума не може бути меншою від нуля!');

        $post->date = date('Y-m-d H:i:s');

        Orders::create_user_bonus($post);

        response(200, DATA_SUCCESS_CREATED);
    }

    public function action_update_bonus_form($post)
    {
        $this->view->display('buy.update.parts.bonus_update_form',
            ['bonus' => Orders::getOne($post->id, 'bonuses')]);
    }

    public function action_update_bonus_sum($post)
    {
        $post->sum = $post->sum < 0 ? 0 : $post->sum;

        Orders::update_bonus_sum($post);

        response(200, DATA_SUCCESS_UPDATED);
    }

    public function action_delete_bonus($post)
    {
        Orders::delete_bonus($post);

        response(200, DATA_SUCCESS_DELETED);
    }

    public function action_update_order_type($post)
    {
        if ($post->atype != '' && $post->liable == '') response(400, 'Виберіть менеджера!');

        if (!isset($post->liable)) $post->liable = 0;

        if ($post->atype == '') {
            $post->atype = 0;
            $post->liable = 0;
        }

        Orders::update($post, $post->id);

        response(200, ['action' => 'close', 'message' => DATA_SUCCESS_UPDATED]);
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

        if ($order->type == 'sending' && $order->street != '')
            $data['marker'] = container(NewPostService::class)->getMarker($order);

        $this->view->display('orders.print.receipt' . ($official ? '_official' : '_new'), $data);
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

    public function action_create_sending($post)
    {
        if (empty($post->fio))
            response(400, 'Заповніть імя!');

        if (empty($post->phone))
            response(400, 'Заповніть телефон!');

        if (empty($post->city))
            response(400, 'Заповніть місто!');

        if (empty($post->warehouse))
            response(400, 'Заповніть відділення!');

        if (!isset($post->products))
            response(400, 'Виберіть хоча-б один товар!');

        $return_shipping = $this->return_shipping_parse($post);
        $products = $post->products;
        unset($post->products);

        Orders::createSending($post, $products, $return_shipping);

        $id = (new OrderCreate)->sending($post, $products, $return_shipping);

        response(200, [
            'action'  => 'redirect',
            'uri'     => uri('orders', ['section' => 'update', 'id' => $id]),
            'message' => 'Всі дані успішно збережено!'
        ]);
    }

    public function actionCreateDelivery(CreateDeliveryRequest $request, OrderCreate $order)
    {
        $data = new Collection($request->except(['products']));
        $products = (new Collection($request->only(['products'])))->collect();

        $id = $order->delivery($data, $products);

        response()->json([
            'location' => uri('orders/update', ['id' => $id])
        ]);
    }

    public function actionCreateSelf(CreateSelfRequest $request, array $products)
    {
        dd($products);
        dd($request->toArray());

        $id = (new OrderCreate)->self($post, $products);

        response(200, [
            'action'  => 'redirect',
            'uri'     => uri('orders', ['section' => 'update', 'id' => $id]),
            'message' => 'Замовлення вдало створено!'
        ]);
    }

    // Оновлення контактної інформації
    public function actionUpdateContacts(UpdateContactsRequest $request, OrderUpdate $orderUpdate)
    {
        $orderUpdate->contacts($request->toArray());

        response()->json(['message' => 'Контакти вдало оновлені!', 'action' => 'close']);
    }

    // Оновлення службової інформації
    public function actionUpdateWorking(UpdateWorkingRequest $request, OrderUpdate $orderUpdate)
    {
        $orderUpdate->working($request->toCollection());

        response()->json([
            'message' => DATA_SUCCESS_UPDATED
        ]);
    }

    // Оновлення адреси
    public function actionUpdateDeliveryAddress(UpdateDeliveryAddressRequest $request, OrderUpdate $orderUpdate)
    {
        $orderUpdate->deliveryAddress();

        response()->json([
            'message' => 'Адресу вдало змінено!'
        ]);
    }

    public function actionUpdateSendingAddress(OrderUpdate $orderUpdate, UpdateSendingAddressRequest $request)
    {
        $orderUpdate->init($request->id)->sendingAddress($request);

        return response()->json(['message' => 'Адреса оновлена!']);
    }

    // Оновлення інформаціїї про оплату
    public function action_update_pay($post)
    {
        if ($post->type == 'delivery' || $post->type == 'self') {
            if (!isset($post->prepayment) || !is_numeric($post->prepayment))
                response(400, 'Введіть коректну суму предоплати!');
        }

        if ($post->type == 'sending')
            if (empty($post->pay_delivery))
                response(400, 'Заповніть платника доставки!');

        $post->prepayment = (integer)$post->prepayment;

        Orders::update_pay($post);

        response(200, ['action' => 'reload', 'message' => DATA_SUCCESS_UPDATED]);
    }

    // Оновлення товарів
    public function actionUpdateProducts(OrderUpdate $order, Collection $products, Collection $data)
    {
        $order->products($products->collect(), $data);

        response(200, DATA_SUCCESS_UPDATED);
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

    public function actionUploadFile(Request $request)
    {
        dd($request->toCollection());
        $file = $_FILES['0'];

        create_folder('/server/uploads/orders/');

        $pi = pathinfo($file['name']);

        $new_name = '/server/uploads/orders/' . $post->id . rand32() . '.' . $pi['extension'];

        if (move_uploaded_file($file['tmp_name'], ROOT . $new_name)) {
            Orders::insert([
                'path'     => $new_name,
                'order_id' => $post->id
            ], 'order_images');

            response(200, DATA_SUCCESS_CREATED);
        } else {
            response(500, 'Фото не завантажено!');
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

    public function actionNewPostCity(string $name = '')
    {
        $response = NewPostCity::select(['id', 'name'])
            ->where('name', 'like', "$name%")
            ->limit(100)
            ->get()
            ->map(function ($item) {
                return [
                    'text' => $item->name,
                    'id'   => $item->id
                ];
            })
            ->toArray();

        return response()->json(['results' => $response]);
    }

    public function actionNewPostWarehouse(int $city_id)
    {
        $city = NewPostCity::findOrFail($city_id);

        $warehouses = NewPostWarehouse::select(['name', 'id'])
            ->where('city_ref', $city->ref)
            ->get();

        $response = '';
        foreach ($warehouses as $item) {
            $response .= "<option value='$item->id'>$item->name</option>";
        }

        return response()->json(['options' => $response]);
    }

}