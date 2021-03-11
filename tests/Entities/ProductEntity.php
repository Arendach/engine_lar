<?php

namespace Tests\Entities;

use App\Models\Product;

trait ProductEntity
{
    public $product;

    public function getProduct(): Product
    {
        if (!$this->product) {
            $this->product = Product::factory()->create([
                'manufacturer_id' => $this->getManufacturer()->id,
                'category_id'     => $this->getCategory()->id,
                'author_id'       => $this->getUser()->id
            ]);

            $this->product->storage_list()->insert([
                'storage_id' => $this->getStorage()->id,
                'product_id' => $this->product->id,
                'count'      => $this->faker->numberBetween(1, 100)
            ]);
        }

        return $this->product;
    }

}