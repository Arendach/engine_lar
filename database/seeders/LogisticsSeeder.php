<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Logistic;
use DB;
use stdClass;

class LogisticsSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('logistics')->get()->each(function (stdClass $item) {
            Logistic::create([
                'id'   => $item->id,
                'name' => htmlspecialchars_decode($item->name)
            ]);
        });
    }
}
