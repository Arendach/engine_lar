<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\Orders\ImportRequest;
use App\Models\Site;
use App\Models\Storage;
use App\Models\User;
use App\Repositories\Shop\OrderRepository;
use App\Repositories\Shop\ProductRepository;
use App\Services\Shop\OrderImportService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class OrdersController extends Controller
{
    private $orderRepository, $productRepository;

    public function __construct(OrderRepository $orderRepository, ProductRepository $productRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
    }

    public function sectionMain(): View
    {
        $orders = $this->orderRepository->getForList();
        $sites = Site::where('key', '!=', null)->get();
        $shop = request('shop', 'shop');

        return view('shop.orders.main', compact('orders', 'sites', 'shop'));
    }

    public function sectionDetails(int $id): View
    {
        $order = $this->orderRepository->getForDetail($id);

        return view('shop.orders.details', compact('order'));
    }

    public function actionImport(ImportRequest $request, OrderImportService $importService): JsonResponse
    {
        $orderShop = $this->orderRepository->getForDetail($request->id);

        $order = $importService->import($request->validated(), $orderShop);

        return response()->json([
            'url' => "/orders/update?id={$order->id}"
        ]);
    }

    public function sectionImportForm(): View
    {
        $storages = Storage::toOptions('name', 'id', fn (Builder $builder) => $builder->where('is_accounted', true));
        $couriers = User::toOptions();

        return view('shop.orders.forms.import', compact('storages', 'couriers'));
    }
}