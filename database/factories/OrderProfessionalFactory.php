<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OrderProfessional;
use Faker\Generator as Faker;

$factory->define(OrderProfessional::class, function (Faker $faker) {
    return [
        'name'  => $faker->text,
        'color' => trim($faker->hexColor, '#')
    ];
});