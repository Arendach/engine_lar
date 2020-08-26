<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Order;
use Illuminate\View\View;

class OrdersController extends Controller
{
    public function sectionMain(): View
    {
        $orders = Order::paginate(20);

        return view('shop.orders.main', compact('orders'));
    }

    public function sectionDetails(int $id): View
    {
        $order = Order::findOrFail($id);

        return view('shop.orders.details', compact('order'));
    }
}