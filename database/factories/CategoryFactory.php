<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name'         => $faker->name,
        'parent_id'    => 0,
        'priority'     => 0,
        'service_code' => $faker->randomNumber()
    ];
});
