<?php

use Illuminate\Database\Seeder;
use App\Models\Attribute;

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
