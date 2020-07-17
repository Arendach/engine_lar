<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function writeOff(Product $product, int $storageId, int $amount): void
    {
        if ($amount == 0) {
            return;
        }

        $product->load('storages');

        if ($product->is_accounted) {
            $storage = $product->storage($storageId);

            if ($storage) {
                $count = $storage->pivot->count;
                $storage->pivot->count = $count - $amount;
                $storage->pivot->save();
            }
        }

        if ($product->is_combine) {
            $product->load('linked')->linked->each(function (Product $product) use ($storageId, $amount) {
                $this->writeOff($product, $storageId, $amount * $product->pivot->minus);
            });
        }
    }

    public function attachHistory(Product $product, array $item): void
    {
        $product->withHistory()->addToOrder($item);
    }

    public function purchased(Product $product, int $storageId): void
    {
        $product->storage($storageId)->pivot->increment('count', $product->pivot->amount);
    }
}