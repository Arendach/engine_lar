<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Storage;
use Faker\Generator as Faker;

$factory->define(Storage::class, function (Faker $faker) {
    return [
        'name'         => $faker->name,
        'is_accounted' => $faker->boolean,
        'info'         => $faker->text,
        'is_delivery'  => $faker->boolean,
        'is_self'      => $faker->boolean,
        'is_sending'   => $faker->boolean,
        'priority'     => 1
    ];
});
