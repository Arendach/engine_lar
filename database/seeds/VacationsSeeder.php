<?php

use Illuminate\Database\Seeder;
use App\Models\Vacation;

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
