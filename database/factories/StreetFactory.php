<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Street;
use Faker\Generator as Faker;

$factory->define(Street::class, function (Faker $faker) {
    return [
        'city'        => 'Київ',
        'district'    => $faker->streetAddress,
        'street_type' => $faker->streetSuffix,
        'name'        => $faker->streetName
    ];
});
