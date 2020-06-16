<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Client;
use App\Models\ClientGroup;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name'            => $faker->name,
        'email'           => $faker->email,
        'phone'           => $faker->phoneNumber,
        'address'         => $faker->address,
        'info'            => $faker->randomHtml(),
        'client_group_id' => factory(ClientGroup::class)->create(),
        'percentage'      => rand(0, 99),
        'user_id'         => factory(User::class)->create(),
        'count_orders'    => rand(0, 999)
    ];
});
