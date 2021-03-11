<?php

namespace Database\Factories;

use App\Models\Pay;
use App\Models\Merchant;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayFactory extends Factory
{
    protected $model = Pay::class;

    public function definition(): array
    {
        return [
            'name'        => $this->faker->name,
            'merchant_id' => Merchant::factory()->create()->id,
            'provider'    => $this->faker->text(100),
            'address'     => $this->faker->text(100),
            'ipn'         => $this->faker->text(100),
            'account'     => $this->faker->text(100),
            'bank'        => $this->faker->text(100),
            'mfo'         => $this->faker->text(100),
            'phone'       => $this->faker->text(100),
            'director'    => $this->faker->text(100),
            'is_cashless' => $this->faker->boolean,
            'is_pdv'      => $this->faker->boolean,
        ];
    }
}