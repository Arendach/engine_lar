<?php

use Illuminate\Database\Seeder;
use App\Models\Shop;

class ShopsSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('shops')->get()->each(function (stdClass $item) {
            Shop::create([
                'id'         => $item->id,
                'name_uk'    => $item->name,
                'name_ru'    => $item->name_ru,
                'address_uk' => $item->address,
                'address_ru' => $item->address_ru,
                'url'        => $item->url_path
            ]);
        });
    }
}
