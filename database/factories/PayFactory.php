<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Pay;
use App\Models\Merchant;
use Faker\Generator as Faker;

$factory->define(Pay::class, function (Faker $faker) {
    return [
        'name'        => $faker->name,
        'merchant_id' => factory(Merchant::class)->create()->id,
        'provider'    => $faker->text(100),
        'address'     => $faker->text(100),
        'ipn'         => $faker->text(100),
        'account'     => $faker->text(100),
        'bank'        => $faker->text(100),
        'mfo'         => $faker->text(100),
        'phone'       => $faker->text(100),
        'director'    => $faker->text(100),
        'is_cashless' => $faker->boolean,
        'is_pdv'      => $faker->boolean,
    ];
});
