<?php

namespace Tests\Feature\Products;

use Tests\TestCase;

class ProductUpdateSeoTest extends TestCase
{
    public function testUpdate()
    {
        $this->authenticate();

        $data = [
            'id'                  => $this->getProduct()->id,
            'meta_title_uk'       => $this->faker->name,
            'meta_title_ru'       => $this->faker->name,
            'meta_keywords_uk'    => $this->faker->name,
            'meta_keywords_ru'    => $this->faker->name,
            'meta_description_uk' => $this->faker->name,
            'meta_description_ru' => $this->faker->name,
        ];

        $this->post('/product/update_seo', $data)
            ->assertStatus(200);

        $this->assertDatabaseHas('products', $data);
    }
}