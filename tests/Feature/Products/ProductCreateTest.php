<?php

namespace Tests\Feature\Products;

use Tests\TestCase;

class ProductCreateTest extends TestCase
{
    public function testCreate()
    {
        $this->authenticate();

        $data = [
            'name_uk'           => $this->faker->name,
            'name_ru'           => $this->faker->name,
            'article'           => $this->faker->name,
            'model_uk'          => $this->faker->name,
            'model_ru'          => $this->faker->name,
            'level1'            => $this->faker->name,
            'level2'            => $this->faker->name,
            'manufacturer_id'   => $this->getManufacturer()->id,
            'is_combine'        => '0',
            'weight'            => '1',
            'volume'            => [1, 2, 3],
            'procurement_price' => $this->faker->numberBetween(1, 99999),
            'price'             => $this->faker->numberBetween(1, 99999),
            'category_id'       => $this->getCategory()->id,
            'service_code'      => $this->faker->numberBetween(1, 999999),
            'description_uk'    => $this->faker->randomHtml(),
            'description_ru'    => $this->faker->randomHtml(),
        ];

        $this->post('/product/create', $data)
            ->assertStatus(200);

        $this->assertDatabaseHas('products', collect($data)->except([
            'level1',
            'level2',
            'volume',
        ])->toArray());
    }
}