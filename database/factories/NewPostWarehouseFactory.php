<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\NewPostWarehouse;
use Faker\Generator as Faker;

$factory->define(NewPostWarehouse::class, function (Faker $faker) {
    return [
        'name'             => $faker->text,
        'ref'              => $faker->md5,
        'city_ref'         => $faker->md5,
        'number'           => $faker->randomNumber(),
        'max_weight_all'   => $faker->numberBetween(1, 999),
        'max_weight_place' => $faker->numberBetween(1, 999),
        'city_id'          => 1,
        'phone'            => $faker->phoneNumber
    ];
});