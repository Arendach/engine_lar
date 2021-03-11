<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attribute;
use DB;
use stdClass;

class AttributesSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('attributes')->get()->each(function (stdClass $attribute) {
            Attribute::create([
                'id'      => $attribute->id,
                'name_uk' => htmlspecialchars_decode($attribute->name),
                'name_ru' => htmlspecialchars_decode($attribute->name_ru),
            ]);
        });
    }
}
