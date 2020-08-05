<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductAsset;
use Faker\Generator as Faker;

$factory->define(ProductAsset::class, function (Faker $faker) {
    return [
        'name'        => $faker->name,
        'storage_id'  => factory(\App\Models\Storage::class)->create(),
        'price'       => $faker->numberBetween(1, 99999),
        'course'      => $faker->numberBetween(1, 9999),
        'code'        => $faker->numberBetween(0, 9999999),
        'description' => $faker->randomHtml()
    ];
});
