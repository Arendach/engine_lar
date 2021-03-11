<?php

namespace Database\Factories;

use App\Models\Inventory;
use App\Models\InventoryProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryProductFactory extends Factory
{
    protected $model = InventoryProduct::class;

    public function definition(): array
    {
        return [
            'inventory_id'    => Inventory::factory()->create(),
            'product_id'      => Product::factory()->create(),
            'amount'          => $this->faker->numberBetween(1, 100),
            'previous_amount' => $this->faker->numberBetween(1, 100)
        ];
    }
}