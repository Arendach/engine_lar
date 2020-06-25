<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Bonus;
use Faker\Generator as Faker;

$factory->define(Bonus::class, function (Faker $faker) {
    return [
        'data'      => $faker->randomNumber(),
        'is_profit' => 1,
        'sum'       => $faker->randomNumber(),
        'user_id'   => factory(\App\Models\User::class)->create(),
        'source'    => 'order',

    ];
});
