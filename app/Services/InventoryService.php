<?php

namespace App\Services;

use App\Models\Inventory;
use App\Models\InventoryProduct;
use App\Models\ProductStorage;

class InventoryService
{
    public function createInventory(array $data, array $products): Inventory
    {
        $inventory = Inventory::create($data);

        foreach ($products as $product) {
            if (!$product['amount']) {
                continue;
            }

            $pts = $this->getPts($data['storage_id'], $product['product_id']);

            $pts->increment('count', $product['amount']);

            $inventory->products()->attach($product['product_id'], array_merge($product, [
                'previous_amount' => $pts->getOriginal('count')
            ]));
        }

        return $inventory;
    }

    private function getPts(int $storageId, int $productId): ProductStorage
    {
        $pts = ProductStorage::filter($storageId, $productId);

        if ($pts->count()) {
            return $pts->first();
        }

        return ProductStorage::create([
            'storage_id' => $storageId,
            'product_id' => $productId,
            'count'      => 0
        ]);
    }
}