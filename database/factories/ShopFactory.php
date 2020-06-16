<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Shop;
use Faker\Generator as Faker;

$factory->define(Shop::class, function (Faker $faker) {
    return [
        'name_uk'    => $faker->name,
        'name_ru'    => $faker->name,
        'address_uk' => $faker->address,
        'address_ru' => $faker->address,
        'url'        => $faker->url
    ];
});
