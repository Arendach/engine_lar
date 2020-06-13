<?php

use Illuminate\Database\Seeder;
use App\Models\OrderHint;

class OrderHintsSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('colors')->get()->each(function (stdClass $item) {
            OrderHint::create([
                'id'          => $item->id,
                'color'       => $item->color,
                'description' => htmlspecialchars_decode($item->description),
                'type'        => in_array($item->type, ['delivery', 'self', 'sending']) ? $item->type : 'common'
            ]);
        });
    }
}