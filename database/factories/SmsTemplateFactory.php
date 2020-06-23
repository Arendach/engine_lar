<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SmsTemplate;
use Faker\Generator as Faker;

$factory->define(SmsTemplate::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'text' => $faker->realText(),
        'type' => $faker->randomKey([
            'delivery',
            'self',
            'sending'
        ])
    ];
});
