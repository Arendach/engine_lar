<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\ClientGroup;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition(): array
    {
        return [
            'name'            => $this->faker->name,
            'email'           => $this->faker->email,
            'phone'           => $this->faker->phoneNumber,
            'address'         => $this->faker->address,
            'info'            => $this->faker->randomHtml(),
            'client_group_id' => ClientGroup::factory()->create(),
            'percentage'      => rand(0, 99),
            'user_id'         => User::factory()->create(),
            'count_orders'    => rand(0, 999)
        ];
    }
}