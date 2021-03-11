<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use stdClass;

class ProductAttributesSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('product_attributes')->get()->each(function (stdClass $item) {
            DB::table('product_attributes')->insert([
                'id'           => $item->id,
                'product_id'   => $item->product_id,
                'attribute_id' => $item->attribute_id
            ]);
        });

        DB::connection('old')->table('product_attribute_variants')->get()->each(function (stdClass $item) {
            DB::table('product_attribute_variants')->insert([
                'id'                   => $item->id,
                'product_attribute_id' => $item->product_attribute_id,
                'value_uk'             => $item->value,
                'value_ru'             => $item->value_ru
            ]);
        });
    }
}
