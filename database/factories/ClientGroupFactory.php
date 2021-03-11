<?php

namespace Database\Factories;

use App\Models\ClientGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientGroupFactory extends Factory
{
    protected $model = ClientGroup::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name
        ];
    }
}