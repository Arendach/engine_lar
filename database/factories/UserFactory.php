<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'login'            => $faker->title,
        'password'         => md5(md5($faker->password())),
        'email'            => $faker->email,
        'name'             => $faker->name,
        'pin'              => rand(100, 999),
        'reserve_funds'    => rand(0, 10000),
        'rate'             => rand(1000, 25000),
        'schedule_notice'  => rand(0, 1),
        'user_position_id' => 1,
        'is_courier'       => rand(0, 1),
        'theme'            => 'flatfly',
        'created_at'       => now(),
        'updated_at'       => now()
    ];
});
