<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Characteristic;
use DB;
use stdClass;

class CharacteristicsSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('characteristics')->get()->each(function (stdClass $item) {
            Characteristic::create([
                'id'         => $item->id,
                'name_uk'    => $item->name_uk,
                'name_ru'    => $item->name_ru,
                'prefix_uk'  => $item->prefix_uk,
                'prefix_ru'  => $item->prefix_ru,
                'postfix_uk' => $item->postfix_uk,
                'postfix_ru' => $item->postfix_ru,
                'type'       => $item->type,
            ]);
        });
    }
}