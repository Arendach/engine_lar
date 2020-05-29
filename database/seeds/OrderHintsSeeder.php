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
                'description' => $item->description,
                'type'        => $item->type
            ]);
        });
    }
}