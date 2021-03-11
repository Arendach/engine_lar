<?php

namespace Database\Factories;

use App\Models\NewPostWarehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewPostWarehouseFactory extends Factory
{
    protected $model = NewPostWarehouse::class;

    public function definition(): array
    {
        return [
            'name'             => $this->faker->text,
            'ref'              => $this->faker->md5,
            'city_ref'         => $this->faker->md5,
            'number'           => $this->faker->randomNumber(),
            'max_weight_all'   => $this->faker->numberBetween(1, 999),
            'max_weight_place' => $this->faker->numberBetween(1, 999),
            'city_id'          => 1,
            'phone'            => $this->faker->phoneNumber
        ];
    }
}