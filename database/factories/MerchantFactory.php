<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Merchant;
use Faker\Generator as Faker;

$factory->define(Merchant::class, function (Faker $faker) {
    return [
        'name'        => $faker->name,
        'password'    => $faker->md5,
        'merchant_id' => $faker->randomNumber()
    ];
});
