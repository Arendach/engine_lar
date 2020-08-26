<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Order;
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

        return view('shop.orders.main', compact('orders'));
    }

    public function sectionDetails(int $id): View
    {
        $order = Order::findOrFail($id);

        return view('shop.orders.details', compact('order'));
    }
}