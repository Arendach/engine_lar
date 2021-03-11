<?php

namespace Database\Factories;

use App\Models\ProductAsset;
use App\Models\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductAssetFactory extends Factory
{
    protected $model = ProductAsset::class;

    public function definition(): array
    {
        return [
            'name'        => $this->faker->name,
            'storage_id'  => Storage::factory()->create(),
            'price'       => $this->faker->numberBetween(1, 99999),
            'course'      => $this->faker->numberBetween(1, 9999),
            'code'        => $this->faker->numberBetween(0, 9999999),
            'description' => $this->faker->randomHtml()
        ];
    }
}