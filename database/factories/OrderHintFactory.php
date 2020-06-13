<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OrderHint;
use Faker\Generator as Faker;

$factory->define(OrderHint::class, function (Faker $faker) {
    return [
        'color'       => $faker->hexColor,
        'description' => $faker->text(30),
        'type'        => $faker->randomKey(['self', 'delivery', 'sending', 'common'])
    ];
});
