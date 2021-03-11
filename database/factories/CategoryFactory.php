<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name'         => $this->faker->name,
            'parent_id'    => 0,
            'priority'     => 0,
            'service_code' => $this->faker->randomNumber()
        ];
    }
}