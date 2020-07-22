<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Inventory;
use App\Models\Manufacturer;
use App\Models\Storage;
use Faker\Generator as Faker;

$factory->define(Inventory::class, function (Faker $faker) {
    return [
        'user_id'         => factory(\App\Models\User::class)->create(),
        'comment'         => $faker->randomHtml(),
        'manufacturer_id' => factory(Manufacturer::class)->create(),
        'storage_id'      => factory(Storage::class)->create(),
    ];
});
