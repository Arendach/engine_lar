<?php

namespace Database\Factories;

use App\Models\Bonus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BonusFactory extends Factory
{
    protected $model = Bonus::class;

    public function definition(): array
    {
        return [
            'data'      => $this->faker->randomNumber(),
            'is_profit' => 1,
            'sum'       => $this->faker->randomNumber(),
            'user_id'   => User::factory()->create(),
            'source'    => 'order',
        ];
    }
}
