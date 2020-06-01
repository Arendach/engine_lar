<?php

use Illuminate\Database\Seeder;
use App\Models\Logistic;

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
