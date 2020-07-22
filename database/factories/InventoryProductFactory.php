<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Inventory;
use App\Models\InventoryProduct;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(InventoryProduct::class, function (Faker $faker) {
    return [
        'inventory_id'    => factory(Inventory::class)->create(),
        'product_id'      => factory(Product::class)->create(),
        'amount'          => $faker->numberBetween(1, 100),
        'previous_amount' => $faker->numberBetween(1, 100)
    ];
});
