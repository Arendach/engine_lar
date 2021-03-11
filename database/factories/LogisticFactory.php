<?php

namespace Database\Factories;

use App\Models\Logistic;
use Illuminate\Database\Eloquent\Factories\Factory;

class LogisticFactory extends Factory
{
    protected $model = Logistic::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->text(32)
        ];
    }
}