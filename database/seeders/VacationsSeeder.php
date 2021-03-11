<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vacation;
use DB;
use stdClass;

class VacationsSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('vacations')->get()->each(function (stdClass $item) {
            Vacation::create([
                'id'         => $item->id,
                'user_id'    => $item->user,
                'created_at' => $item->date,
                'updated_at' => $item->date,
                'date'       => $item->date
            ]);
        });
    }
}
