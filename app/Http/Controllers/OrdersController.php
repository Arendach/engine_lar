<?php

namespace App\Http\Controllers;

use App\Http\Requests\Orders\CreateBonusRequest;
use App\Http\Requests\Orders\CreateSendingRequest;
use App\Http\Requests\Orders\CreateTransactionRequest;
use App\Http\Requests\Orders\DeleteBonusRequest;
use App\Http\Requests\Orders\DeleteProductRequest;
use App\Http\Requests\Orders\UpdateAddressRequest;
use App\Http\Requests\Orders\UpdateOrderProfessionalRequest;
use App\Http\Requests\Orders\UpdatePayRequest;
use App\Http\Requests\Orders\UpdateProductsRequest;
use App\Http\Requests\Orders\UploadFileRequest;
use App\Models\OrderFile;
use App\Models\OrderTransaction;
use App\Repositories\ProductRepository;
use App\Services\NewPost;
use App\Services\OrderService;
use App\Services\PrivateBankService;
use Exception;
use App\Models\BlackDate;
use App\Services\CategoryTree;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
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
        $order = Order::with(['products' => function (BelongsToMany $builder) {
            $builder->orderBy('pivot_id', 'desc');
        }])->findOrFail($id);

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

        return view('buy.update.main', $data);
    }

    public function sectionChanges(int $id)
    {
        $order = Order::with('history')->findOrFail($id);

        return view('buy.changes.main', compact('order'));
    }

    public function actionDeleteProduct(DeleteProductRequest $request, OrderService $orderService): void
    {
        $orderService->deleteProduct($request->get('order_id'), $request->get('pivot_id'));
    }

    // Пошук товарів
    public function actionSearchProducts(string $type, $search): string
    {
        return app(ProductRepository::class)
            ->search($search, $type, 50)
            ->map(function (Product $product) {
                return ['text' => "<div data-id='{$product->id}' class='item searched'> {$product->name}</div>"];
            })
            ->implode('text', "\n");
    }

    // Вивод вибраних товарів при пошуку
    public function actionGetProduct(string $type, int $id): View
    {
        $result[] = Product::find($id);

        return view('buy.show_found_products', ['products' => $result, 'type' => $type]);
    }

    public function actionChangeType($post)
    {
        (new OrderUpdate($post->id))->changeType($post->type);

        response(200, 'Тип замовлення вдало змінений!');
    }

    public function actionPreview(int $id): View
    {
        return view('orders.preview', ['order' => Order::findOrFail($id)]);
    }

    public function actionCreateBonus(CreateBonusRequest $request, OrderService $orderService): void
    {
        $orderService->createBonus($request->validated());
    }

    public function actionDeleteBonus(DeleteBonusRequest $request, OrderService $orderService): void
    {
        $orderService->deleteBonus($request->get('id'));
    }

    public function actionUpdateOrderProfessional(UpdateOrderProfessionalRequest $request, OrderService $orderService): void
    {
        $orderService->update($request->get('id'), $request->validated());
    }

    // Роздруковка маршрутного листа
    public function sectionRouteList(string $ids): View
    {
        $ids = explode(':', $ids);

        $orders = Order::with('products')->find($ids);

        return view('orders.print.route_list', compact('orders'));
    }

    // Товарний чек
    public function sectionReceipt(int $id, bool $official = false)
    {
        /** @var Order $order */
        $order = Order::with(['products', 'pay', 'hint'])->findOrFail($id);
        $marker = app(NewPost::class)->getMarker($order);

        $view = $official ? 'receipt_official' : 'receipt';

        return view("orders.print.$view", compact('marker', 'order'));
    }

    // Рахунок фактура
    public function sectionInvoice(int $id)
    {
        $order = Order::with('pay', 'products')->findOrFail($id);

        $pay = $order->pay;

        return view('orders.print.invoice', compact('order', 'pay'));
    }

    // Роздруковка видаткової накладної
    public function sectionSalesInvoice(int $id)
    {
        $order = Order::with('pay', 'products')->findOrFail($id);

        $pay = $order->pay;

        return view('orders.print.sales_invoice', compact('order', 'pay'));
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
    public function actionUpdatePay(UpdatePayRequest $request, OrderService $orderService): void
    {
        $orderService->update($request->get('id'), $request->validated());
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

    public function actionSearchTransactions(int $id): View
    {
        $order = Order::findOrFail($id)->load('pay', 'pay.merchant', 'pay.merchant.cards');

        $transactions = app(PrivateBankService::class)->searchTransactions($order);

        return view('buy.update.parts.transaction_add', compact('transactions', 'order'));
    }

    public function actionAddTransactions(CreateTransactionRequest $request, OrderService $orderService): void
    {
        $orderService->attachTransactions($request->get('id'), $request->validated());
    }

    public function actionDeleteTransaction(int $id): void
    {
        OrderTransaction::findOrFail($id)->delete();
    }
}