<?php

use Illuminate\Database\Seeder;

class ProductCharacteristicsSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('product_characteristics')->get()->each(function (stdClass $item) {
            DB::table('product_characteristics')->insert([
                'product_id'        => $item->product_id,
                'characteristic_id' => $item->characteristic_id,
                'value_uk'          => $item->value_uk,
                'value_ru'          => $item->value_ru,
                'filter_uk'         => $item->filter_uk,
                'filter_ru'         => $item->filter_ru,
            ]);
        });
    }
}
