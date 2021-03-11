<?php

namespace Database\Factories;

use App\Models\SmsTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

class SmsTemplateFactory extends Factory
{
    protected $model = SmsTemplate::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'text' => $this->faker->realText(),
            'type' => $this->faker->randomKey([
                'delivery',
                'self',
                'sending'
            ])
        ];
    }
}