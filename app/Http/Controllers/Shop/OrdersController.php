<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Order;
use App\Models\Shop\Product;
use App\Models\Order as BaseOrder;
use App\Models\Site;
use App\Repositories\Shop\OrderRepository;
use App\Repositories\Shop\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrdersController extends Controller
{
    private $orderRepository, $productRepository;

    public function __construct(OrderRepository $orderRepository,ProductRepository $productRepository)
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
    public function actionImport(Request $request){
        $order = app(\App\Models\Shop\Order::class)->strictConnection($request->shop)->find($request->id);
        return json_encode($order);
    }
}