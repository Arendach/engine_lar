<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Order;
use App\Models\Site;
use App\Repositories\Shop\OrderRepository;
use Illuminate\View\View;

class OrdersController extends Controller
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function sectionMain(): View
    {
        $orders = $this->orderRepository->getForList();
        $sites = Site::where('key', '!=', null)->get();
        return view('shop.orders.main', compact('orders', 'sites'));
    }

    public function sectionDetails(int $id): View
    {
        $order = $this->orderRepository->getForDetail($id);

        return view('shop.orders.details', compact('order'));
    }
}