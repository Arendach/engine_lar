<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductHistory;
use App\Models\Storage;

class ProductHistoryService
{
    /** @var ProductHistory $model */
    private $model;

    /** @var Product $product */
    private $product;

    public function __construct()
    {
        $this->model = app(ProductHistory::class);
    }

    public function setProduct(Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function addToOrder(array $data): Product
    {
        unset($data['product_id']);

        $data['storage_name'] = $this->getStorageName($data['storage_id']);

        $this->save($data, 'add_to_order');

        return $this->product;
    }

    public function syncWithOrder(array $data): Product
    {

        /*unset($data['product_id']);

        $data['storage_name'] = $this->getStorageName($data['storage_id']);

        $this->save($data, 'add_to_order');*/

        return $this->product;
    }

    public function deleteFromOrder(array $data): Product
    {
        return $this->product;
    }

    public function save(array $data, string $type)
    {
        $this->model->create([
            'product_id' => $this->product->id,
            'type'       => $type,
            'data'       => $data,
            'user_id'    => user()->id,
        ]);
    }

    public function getStorageName(int $id): string
    {
        return Storage::find($id)->name ?? '';
    }

    public function purchased(int $storageId): void
    {
        $data = [
            'storage_id'   => $this->product->pivot->storage_id,
            'storage_name' => $this->product->storage($storageId)->name,
            'amount'       => $this->product->pivot->amount,
            'price'        => $this->product->pivot->price
        ];

        $this->save($data, 'purchases');
    }
}