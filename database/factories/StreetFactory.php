<?php

namespace Database\Factories;

use App\Models\Street;
use Illuminate\Database\Eloquent\Factories\Factory;

class StreetFactory extends Factory
{
    protected $model = Street::class;

    public function definition(): array
    {
        return [
            'city'        => 'Київ',
            'district'    => $this->faker->streetAddress,
            'street_type' => $this->faker->streetSuffix,
            'name'        => $this->faker->streetName
        ];
    }
}
