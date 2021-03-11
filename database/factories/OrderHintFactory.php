<?php

namespace Database\Factories;

use App\Models\OrderHint;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderHintFactory extends Factory
{
    protected $model = OrderHint::class;

    public function definition(): array
    {
        return [
            'color'       => $this->faker->hexColor,
            'description' => $this->faker->text(30),
            'type'        => $this->faker->randomKey(['self', 'delivery', 'sending', 'common'])
        ];
    }
}