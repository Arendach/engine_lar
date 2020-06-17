<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name_uk'             => $faker->name,
        'name_ru'             => $faker->name,
        'article'             => $faker->name,
        'model_ru'            => $faker->word,
        'model_uk'            => $faker->word,
        'service_code'        => 12341,
        'description_ru'      => $faker->randomHtml(),
        'description_uk'      => $faker->randomHtml(),
        'price'               => $faker->randomFloat(),
        'product_key'         => $faker->md5,
        'procurement_price'   => $faker->randomFloat(),
        'is_accounted'        => $faker->boolean,
        'is_combine'          => $faker->boolean,
        'weight'              => $faker->randomFloat(),
        'packing'             => '[0,0,0]',
        'video'               => $faker->word,
        'volume'              => '[0,0,0]',
        'id_storage'          => $faker->text,
        'meta_title_uk'       => $faker->text,
        'meta_description_uk' => $faker->text,
        'meta_keywords_uk'    => $faker->text,
        'meta_description_ru' => $faker->text,
        'meta_keywords_ru'    => $faker->text,
        'meta_title_ru'       => $faker->text,
        'category_id'         => factory(Category::class),
        'manufacturer_id'     => factory(Manufacturer::class),
        'author_id'           => factory(User::class)
    ];
});
