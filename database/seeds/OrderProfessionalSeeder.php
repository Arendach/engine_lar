<?php

use Illuminate\Database\Seeder;
use App\Models\OrderProfessional;

class OrderProfessionalSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('order_type')->get()->each(function (stdClass $item) {
            OrderProfessional::create([
                'id'    => $item->id,
                'name'  => $item->name,
                'color' => $item->color
            ]);
        });
    }
}
