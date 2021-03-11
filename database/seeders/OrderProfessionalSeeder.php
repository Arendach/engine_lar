<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderProfessional;
use DB;
use stdClass;

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
