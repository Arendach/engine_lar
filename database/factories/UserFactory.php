<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'login'            => $this->faker->title,
            'password'         => md5(md5($this->faker->password())),
            'email'            => $this->faker->email,
            'name'             => $this->faker->name,
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
    }
}