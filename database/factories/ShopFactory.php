<?php

namespace Database\Factories;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{
    protected $model = Shop::class;

    public function definition(): array
    {
        return [
            'name_uk'    => $this->faker->name,
            'name_ru'    => $this->faker->name,
            'address_uk' => $this->faker->address,
            'address_ru' => $this->faker->address,
            'url'        => $this->faker->url
        ];
    }
}
