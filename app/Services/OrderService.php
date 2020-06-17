<?php

namespace App\Services;

use App\Models\Order;

class OrderService
{
    public function updateAddress(int $id, array $data): void
    {
        Order::findOrFail($id)->fill($data)->withHistory()->setType('update_address')->update();
    }

    public function update(int $id, array $data): void
    {
        Order::findOrFail($id)->fill($data)->withHistory()->update();
    }

    public function createSelf(array $data): int
    {
        // get products
        $products = $data['products'];
        unset($data['products']);

        // create order
        $order = Order::create($data);

        // attach products
        $order->products()->sync($products);

        // set order sum
        $order->full_sum = $order->sum;

        $order->withHistory()->create($products);

        // return order id
        return $order->id;
    }


    public function createSending(array $data): int
    {
        // get products
        $products = $data['products'];
        unset($data['products']);

        // create order
        $order = Order::create($data);

        // attach products
        $order->products()->sync($products);

        // set order sum
        $order->full_sum = $order->sum;

        $order->withHistory()->create($products);

        // return order id
        return $order->id;
    }

    public function createDelivery(array $data): int
    {
        // get products
        $products = $data['products'];
        unset($data['products']);

        // create order
        $order = Order::create($data);

        // attach products
        $order->products()->sync($products);

        // set order sum
        $order->full_sum = $order->sum;

        $order->withHistory()->create($products);

        // return order id
        return $order->id;
    }
}