<?php

namespace App\Services;

use App\Models\Order;

class OrderService
{
    public function updateSelfAddress(int $id, array $data): void
    {
        Order::findOrFail($id)->fill($data)->withHistory()->update();
    }

    public function update(int $id, array $data): void
    {
        Order::findOrFail($id)->fill($data)->withHistory()->update();
    }

    public function createSelf(array $data): int
    {
        $order = Order::make($data)->withHistory()->create();

        return $order->id;
    }
}