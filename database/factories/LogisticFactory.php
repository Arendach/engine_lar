<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Logistic;
use Faker\Generator as Faker;

$factory->define(Logistic::class, function (Faker $faker) {
    return [
        'name' => $faker->text(32)
    ];
});
