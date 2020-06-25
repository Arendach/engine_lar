<?php

namespace Tests\Feature\Orders;

use App\Models\Product;
use Tests\TestCase;

class SearchProductsTest extends TestCase
{
    public function testSearch()
    {
        $this->authenticate();

        $product = factory(Product::class)->create();

        $this->post('/orders/search_products', [
            'type'   => 'other',
            'search' => $product->article
        ])
            ->assertStatus(200)
            ->assertSee($product->id)
            ->assertSee($product->name);
    }


    public function testGetProduct()
    {
        $this->authenticate();

        $product = factory(Product::class)->create();

        $this->post('/orders/get_product', [
            'type' => 'sending',
            'id'   => $product->id
        ])
            ->assertStatus(200)
            ->assertSee($product->name)
            ->assertSee($product->id);
    }
}