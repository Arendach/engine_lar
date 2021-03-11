<?php

namespace Database\Factories;

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
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'type'                  => 'delivery',
            'status'                => 0,
            'fio'                   => $this->faker->name,
            'phone'                 => $this->faker->phoneNumber,
            'phone2'                => $this->faker->phoneNumber,
            'email'                 => $this->faker->email,
            'city'                  => $this->faker->city,
            'address'               => $this->faker->address,
            'street'                => $this->faker->streetName,
            'comment_address'       => $this->faker->text(),
            'warehouse'             => $this->faker->text,
            'is_payed'              => $this->faker->boolean,
            'prepayment'            => $this->faker->randomFloat(),
            'discount'              => $this->faker->randomFloat(),
            'delivery_price'        => $this->faker->randomFloat(),
            'full_sum'              => $this->faker->randomFloat(),
            'comment'               => $this->faker->text(),
            'sending'               => rand(1, 6),
            'author_id'             => User::factory()->create(),
            'pay_id'                => Pay::factory()->create(),
            'courier_id'            => User::factory()->create(),
            'logistic_id'           => Logistic::factory()->create(),
            'hint_id'               => OrderHint::factory()->create(),
            'client_id'             => Client::factory()->create(),
            'site_id'               => Site::factory()->create(),
            'order_professional_id' => OrderProfessional::factory()->create(),
            'new_post_city_id'      => NewPostCity::factory()->create(),
            'new_post_warehouse_id' => NewPostWarehouse::factory()->create(),
            'time_with'             => $this->faker->time(),
            'time_to'               => $this->faker->time(),
            'date_delivery'         => now(),
            'shop_id'               => Shop::factory()->create(),
        ];
    }
}