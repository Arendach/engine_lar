<?php

namespace App\Services;

use App\Models\Purchase;
use App\Models\PurchasePayment;

class PurchaseService
{
    public function create(array $data): Purchase
    {
        $products = $data['products'];

        unset($data['products']);

        $purchase = Purchase::create($data);

        $purchase->products()->attach($products);

        $purchase->update([
            'sum' => $purchase->getSum()
        ]);

        return $purchase;
    }

    public function createPayment(int $id, array $data): PurchasePayment
    {
        $purchase = Purchase::findOrFail($id);

        $purchasePayment = $purchase->payments()->create($data);

        $payed = $purchase->load('payments')->payed;

        // якщо проплата рівна сумі закупки то ставимо статус оплачено повність інакше оплачено частково
        $purchase->update([
            'status' => $payed == $purchase->sum ? 2 : 1
        ]);

        app(ReportService::class)->createPurchasePayment($purchasePayment);

        return $purchasePayment;
    }

    public function update(int $id, array $data): void
    {
        $purchase = Purchase::findOrFail($id);

        $purchase->update(collect($data)->except('products')->toArray());

        $purchase->products()->sync($data['products']);

        $purchase->update([
            'sum' => $purchase->load('products')->getSum()
        ]);
    }

    public function updateType(int $id): void
    {
        $purchase = Purchase::findOrFail($id)
            ->load('products');

        $purchase->update(['type' => 1]);

        foreach ($purchase->products as $product) {
            app(ProductService::class)->purchased($product, $purchase->storage_id);

            $product->withHistory()->purchased($purchase->storage_id);
        }
    }
}