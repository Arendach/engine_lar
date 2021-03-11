<?php

namespace Database\Factories;

use App\Models\OrderProfessional;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderProfessionalFactory extends Factory
{
    protected $model = OrderProfessional::class;

    public function definition(): array
    {
        return [
            'name'  => $this->faker->text,
            'color' => trim($this->faker->hexColor, '#')
        ];
    }
}