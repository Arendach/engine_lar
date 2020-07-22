<?php

namespace Tests\Feature\Purchase;

use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Storage;
use Tests\TestCase;

class PurchaseCreateTest extends TestCase
{
    /*public function testCreate()
    {
        $this->authenticate();

        $product = factory(Product::class)->create();
        $storage = factory(Storage::class)->create();
        $manufacturer = factory(Manufacturer::class)->create();

        $data = [
            'products'        => [
                'amount'     => rand(1, 100),
                'price'      => $product->procurement_price,
                'product_id' => $product->id
            ],
            'storage_id'      => $storage->id,
            'manufacturer_id' => $manufacturer->id,
            'comment'         => null
        ];

        $response = $this->post('/purchase/create', $data);

        $response->assertStatus(200)
            ->assertJsonFragment(['url' => '']);
    }*/
}