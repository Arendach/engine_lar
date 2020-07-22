<?php

namespace Tests\Feature;

use Tests\TestCase;

class InventoryTest extends TestCase
{
    public function testCreate(): void
    {
        $this->authenticate();

        $product = $this->getProduct();
        $amount = $this->faker->numberBetween(1, 100);

        $this->post('/inventory/create', [
            'manufacturer_id' => $product->manufacturer->id,
            'storage_id'      => $product->storage_list->first()->id,
            'products'        => [
                [
                    'product_id' => $product->id,
                    'amount'     => $amount
                ]
            ]
        ])
            ->assertStatus(200);

        $this->assertDatabaseHas('inventory', [
            'manufacturer_id' => $product->manufacturer->id,
            'storage_id'      => $product->storage_list->first()->id
        ]);

        $this->assertDatabaseHas('inventory_product', [
            'product_id' => $product->id,
            'amount'     => $amount
        ]);
    }

    public function testShow(): void
    {
        $this->authenticate();

        $inventory = $this->getInventory();

        $this->get('/inventory/main')
            ->assertStatus(200)
            ->assertSee($inventory->manufacturer->name)
            ->assertSee($inventory->storage->name)
            ->assertSee($inventory->products->count());
    }

    public function testPrint(): void
    {
        $this->authenticate();

        $inventory = $this->getInventory();
        $product = $inventory->products->first();

        $response = $this->get("/inventory/print?id={$inventory->id}");

        $response
            ->assertStatus(200);

        $response
            ->assertSee($inventory->human('created_at', true))
            ->assertSee($inventory->manufacturer->name)
            ->assertSee($inventory->storage->name)
            ->assertSee($inventory->user->login)
            ->assertSee($inventory->comment);

        $response
            ->assertSee($product->url)
            ->assertSee($product->name)
            ->assertSee($product->pivot->previous_amount);
    }

    public function testCratePage(): void
    {
        $this->authenticate();

        $manufacturer = $this->getManufacturer();
        $storage = $this->getStorage();
        $category = $this->getCategory();

        $this->get('inventory/create')
            ->assertStatus(200)
            ->assertSee($manufacturer->name)
            ->assertSee($storage->name)
            ->assertSee($category->name);
    }

    public function testForm(): void
    {
        $this->authenticate();

        $manufacturer = $this->getManufacturer();
        $storage = $this->getStorage();
        $product = $this->getProduct();

        $this->post('/inventory/form', [
            'manufacturer_id' => $manufacturer->id,
            'storage_id'      => $storage->id
        ])
            ->assertStatus(200)
            ->assertSee($product->name);
    }
}