<?php

namespace Database\Factories;

use App\Models\Manufacturer;
use Illuminate\Database\Eloquent\Factories\Factory;

class ManufacturerFactory extends Factory
{
    protected $model = Manufacturer::class;

    public function definition(): array
    {
        return [
            'name_ru' => $this->faker->name,
            'name_uk' => $this->faker->name,
            'email'   => $this->faker->email,
            'phone'   => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'info'    => $this->faker->randomHtml()
        ];
    }
}