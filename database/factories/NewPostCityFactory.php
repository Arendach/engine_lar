<?php

namespace Database\Factories;

use App\Models\NewPostCity;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewPostCityFactory extends Factory
{
    protected $model = NewPostCity::class;

    public function definition(): array
    {
        return [
            'name'   => $this->faker->text,
            'ref'    => $this->faker->md5,
            'prefix' => $this->faker->title
        ];
    }
}