<?php

namespace App\Http\Composers;

use App\Models\Shop\Order;
use App\Repositories\Shop\OrderRepository;
use App\Services\Shop\OrderImportService;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class CreateOrderComposer
{
    private Order $order;
    private OrderRepository $orderRepository;
    private Collection $data;
    private OrderImportService $importService;

    public function __construct(OrderRepository $orderRepository, OrderImportService $importService)
    {
        $this->orderRepository = $orderRepository;
        $this->importService = $importService;

        $this->data = new Collection();

        if (request('shop_order_id')) {
            $this->order = $this->orderRepository->getForDetail(request('shop_order_id'));
        }
    }

    public function compose(View $view): void
    {
        if (!($this->order instanceof Order)) {
            return;
        }

        $this->orderInfoMapping();

        $view->with($this->data->toArray());
    }

    private function orderInfoMapping(): void
    {
        $data = $this->importService->mapping($this->order);

        $this->data = $this->data->merge($data);
    }
}