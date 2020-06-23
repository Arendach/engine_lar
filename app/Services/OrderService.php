<?php

namespace App\Services;

use App\Models\Bonus;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;

class OrderService
{
    public function updateAddress(int $id, array $data): void
    {
        Order::findOrFail($id)->fill($data)->withHistory()->setType('update_address')->update();
    }

    public function updateProducts(int $id, array $data): void
    {
        // get products
        $products = $data['products'];
        unset($data['products']);

        // update order
        /** @var Order $order */
        $order = Order::with('products')->findOrFail($id);

        $order->fill($data);

        $fullSum = collect($products)->each(function (array $item) use ($order) {
            /** @var Product $product */
            $product = Product::with('storages')->find($item['product_id']);

            if (isset($item['pivot_id'])) {
                $pivot = $order->products->where('pivot.id', $item['pivot_id'])->first()->pivot;

                $oldPivot = clone $pivot;

                $pivot->update(
                    collect($item)->only('amount', 'storage_id', 'price')->toArray()
                );

                $this->syncProductIfPivot($oldPivot, $pivot, $product);
            } else {
                $order->products()->attach(
                    $item['product_id'],
                    collect($item)->only('storage_id', 'amount', 'price')->toArray()
                );

                app(ProductService::class)->writeOff($product, $item['storage_id'], $item['amount']);

                app(ProductService::class)->attachHistory($product, array_merge($item, [
                    'order_id' => $order->id
                ]));
            }
        })->sum(function (array $item) {
            return $item['amount'] * $item['price'];
        });

        $order->full_sum = $fullSum;

        $order->save();
    }


    public function update(int $id, array $data): void
    {
        Order::findOrFail($id)->fill($data)->withHistory()->update();
    }

    public function create(array $data): int
    {
        // get products
        $products = $data['products'];
        unset($data['products']);

        // create order
        $order = Order::create($data);

        // attach products
        collect($products)->each(function (array $item) use ($order) {
            /** @var Product $product */
            $product = Product::with('storages')->find($item['product_id']);

            $order->products()->attach($item['product_id'], $item);

            app(ProductService::class)->writeOff($product, $item['storage_id'], $item['amount']);

            app(ProductService::class)->attachHistory($product, array_merge($item, [
                'order_id' => $order->id
            ]));
        });

        // set order sum
        $order->full_sum = $order->sum + $order->delivery_price - $order->discount;

        $order->withHistory()->create($products);

        return $order->id;
    }

    private function syncProductIfPivot(OrderProduct $oldPivot, OrderProduct $newPivot, Product $product): void
    {
        $oldAmount = $oldPivot->amount;
        $newAmount = $newPivot->amount;

        $oldStorage = $oldPivot->storage_id;
        $newStorage = $newPivot->storage_id;

        if ($oldStorage == $newStorage) {
            app(ProductService::class)->writeOff($product, $oldStorage, $newAmount - $oldAmount);

            app(ProductHistoryService::class)->syncWithOrder([
                'amount'     => ['old' => $oldAmount, 'new' => $newAmount],
                'storage_id' => ['old' => $oldStorage, 'new' => $newStorage],
                'price'      => ['old' => $oldPivot->price, 'new' => $newPivot->price]
            ]);
        } else {
            app(ProductService::class)->writeOff($product, $oldStorage, -1 * abs($oldAmount));
            app(ProductService::class)->writeOff($product, $newStorage, $newAmount);

            app(ProductHistoryService::class)->syncWithOrder([
                'amount'     => ['old' => $oldAmount, 'new' => $newAmount],
                'storage_id' => ['old' => $oldStorage, 'new' => $newStorage],
                'price'      => ['old' => $oldPivot->price, 'new' => $newPivot->price]
            ]);
        }
    }

    public function createBonus(array $data): void
    {
        $bonus = Bonus::create($data);

        app(BonusService::class)->addToSchedule($bonus);
    }
}