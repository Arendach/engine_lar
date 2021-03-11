<?php

namespace Database\Factories;

use App\Models\Merchant;
use Illuminate\Database\Eloquent\Factories\Factory;

class MerchantFactory extends Factory
{
    protected $model = Merchant::class;

    public function definition(): array
    {
        return [
            'name'        => $this->faker->name,
            'password'    => $this->faker->md5,
            'merchant_id' => $this->faker->randomNumber()
        ];
    }
}