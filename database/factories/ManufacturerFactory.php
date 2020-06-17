<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Manufacturer;
use Faker\Generator as Faker;

$factory->define(Manufacturer::class, function (Faker $faker) {
    return [
        'name_ru' => $faker->name,
        'name_uk' => $faker->name,
        'email'   => $faker->email,
        'phone'   => $faker->phoneNumber,
        'address' => $faker->address,
        'info'    => $faker->randomHtml()
    ];
});
