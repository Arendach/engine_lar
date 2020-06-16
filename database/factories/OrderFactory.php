<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use App\Models\User;
use App\Models\Pay;
use App\Models\Logistic;
use App\Models\OrderHint;
use App\Models\Client;
use App\Models\Site;
use App\Models\OrderProfessional;
use App\Models\NewPostCity;
use App\Models\NewPostWarehouse;
use App\Models\Shop;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'type'                  => 'delivery',
        'status'                => 0,
        'fio'                   => $faker->name,
        'phone'                 => $faker->phoneNumber,
        'phone2'                => $faker->phoneNumber,
        'email'                 => $faker->email,
        'city'                  => $faker->city,
        'address'               => $faker->address,
        'street'                => $faker->streetName,
        'comment_address'       => $faker->text(),
        'warehouse'             => $faker->text,
        'is_payed'              => $faker->boolean,
        'prepayment'            => $faker->randomFloat(),
        'discount'              => $faker->randomFloat(),
        'delivery_price'        => $faker->randomFloat(),
        'full_sum'              => $faker->randomFloat(),
        'comment'               => $faker->text(),
        'sending'               => rand(1, 6),
        'author_id'             => factory(User::class)->create(),
        'pay_id'                => factory(Pay::class)->create(),
        'courier_id'            => factory(User::class)->create(),
        'logistic_id'           => factory(Logistic::class)->create(),
        'hint_id'               => factory(OrderHint::class)->create(),
        'client_id'             => factory(Client::class)->create(),
        'site_id'               => factory(Site::class)->create(),
        'order_professional_id' => factory(OrderProfessional::class)->create(),
        'new_post_city_id'      => factory(NewPostCity::class)->create(),
        'new_post_warehouse_id' => factory(NewPostWarehouse::class)->create(),
        'time_with'             => $faker->time(),
        'time_to'               => $faker->time(),
        'date_delivery'         => now(),
        'shop_id'               => factory(Shop::class)->create(),
    ];
});
