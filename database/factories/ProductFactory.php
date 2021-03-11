<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name_uk'             => $this->faker->name,
            'name_ru'             => $this->faker->name,
            'article'             => $this->faker->name,
            'model_ru'            => $this->faker->word,
            'model_uk'            => $this->faker->word,
            'service_code'        => 12341,
            'description_ru'      => $this->faker->randomHtml(),
            'description_uk'      => $this->faker->randomHtml(),
            'price'               => $this->faker->randomFloat(),
            'product_key'         => $this->faker->md5,
            'procurement_price'   => $this->faker->randomFloat(),
            'is_accounted'        => $this->faker->boolean,
            'is_combine'          => $this->faker->boolean,
            'weight'              => $this->faker->randomFloat(),
            'packing'             => '[0,0,0]',
            'video'               => $this->faker->word,
            'volume'              => '[0,0,0]',
            'id_storage'          => $this->faker->text,
            'meta_title_uk'       => $this->faker->text,
            'meta_description_uk' => $this->faker->text,
            'meta_keywords_uk'    => $this->faker->text,
            'meta_description_ru' => $this->faker->text,
            'meta_keywords_ru'    => $this->faker->text,
            'meta_title_ru'       => $this->faker->text,
            'category_id'         => Category::factory()->create(),
            'manufacturer_id'     => Manufacturer::factory()->create(),
            'author_id'           => User::factory()->create()
        ];
    }
}