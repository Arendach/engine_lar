<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ClientGroup;
use Faker\Generator as Faker;

$factory->define(ClientGroup::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});
