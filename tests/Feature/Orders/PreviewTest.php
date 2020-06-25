<?php

namespace Tests\Feature\Orders;

use App\Models\Order;
use App\Models\Product;
use App\Models\Storage;
use Tests\TestCase;

class PreviewTest extends TestCase
{
    public function testPreview()
    {
        $this->authenticate();

        $order = factory(Order::class)->create();
        $product = factory(Product::class)->create();
        $storage = factory(Storage::class)->create();

        $order->products()->attach($product, [
            'storage_id' => $storage->id,
            'amount'     => 1
        ]);

        $this->post('/orders/preview', [
            'id' => $order->id
        ])
            ->assertStatus(200)
            ->assertSee($product->name);
    }
}