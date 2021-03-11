<?php

namespace Database\Factories;

use App\Models\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

class StorageFactory extends Factory
{
    protected $model = Storage::class;

    public function definition(): array
    {
        return [
            'name'         => $this->faker->name,
            'is_accounted' => $this->faker->boolean,
            'info'         => $this->faker->text,
            'is_delivery'  => $this->faker->boolean,
            'is_self'      => $this->faker->boolean,
            'is_sending'   => $this->faker->boolean,
            'priority'     => 1
        ];
    }
}