<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\NewPostCity;
use Faker\Generator as Faker;

$factory->define(NewPostCity::class, function (Faker $faker) {
    return [
        'name'   => $faker->text,
        'ref'    => $faker->md5,
        'prefix' => $faker->title
    ];
});
