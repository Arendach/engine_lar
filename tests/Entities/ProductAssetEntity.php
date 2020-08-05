<?php

namespace Tests\Entities;

use App\Models\ProductAsset;

trait ProductAssetEntity
{
    public $productAsset;

    public function getProductAsset(): ProductAsset
    {
        if (!$this->productAsset) {
            $this->productAsset = factory(ProductAsset::class)->create([
                'storage_id' => $this->getStorage()->id
            ]);
        }

        return $this->productAsset;
    }
}