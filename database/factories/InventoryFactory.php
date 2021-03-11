<?php

namespace Database\Factories;

use App\Models\Inventory;
use App\Models\Manufacturer;
use App\Models\Storage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryFactory extends Factory
{
    protected $model = Inventory::class;

    public function definition(): array
    {
        return [
            'user_id'         => User::factory()->create(),
            'comment'         => $this->faker->randomHtml(),
            'manufacturer_id' => Manufacturer::factory()->create(),
            'storage_id'      => Storage::factory()->create(),
        ];
    }
}