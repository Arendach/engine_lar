<?php

namespace App\Http\Composers;

use App\Models\Shop\Order;
use App\Repositories\Shop\OrderRepository;
use App\Services\Shop\OrderImportService;
use Illuminate\View\View;

class CreateOrderProductsComposer
{
    private Order $order;
    private OrderRepository $orderRepository;
    private OrderImportService $importService;

    public function __construct(OrderRepository $orderRepository, OrderImportService $importService)
    {
        $this->orderRepository = $orderRepository;
        $this->importService = $importService;

        if (request('shop_order_id')) {
            $this->order = $this->orderRepository->getForDetail(request('shop_order_id'));
        }
    }

    public function compose(View $view): void
    {
        if (!($this->order instanceof Order)) {
            return;
        }

        $products = $this->importService->mappingProducts($this->order);

        $view->with(compact('products'));
    }
}