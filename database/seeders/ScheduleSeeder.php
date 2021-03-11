<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\ScheduleMonth;
use DB;
use stdClass;

class ScheduleSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('work_schedule_month')->get()->each(function (stdClass $item) {
            ScheduleMonth::create([
                'price_month' => $item->price_month,
                'for_car'     => $item->for_car,
                'bonus'       => $item->bonus,
                'fine'        => $item->fine,
                'coefficient' => $item->coefficient,
                'user_id'     => $item->user,
                'year'        => $item->year,
                'month'       => $item->month,
                'created_at'  => $item->date,
                'updated_at'  => $item->date,
            ]);
        });

        DB::connection('old')->table('work_schedule_day')->get()->each(function (stdClass $item) {
            $year = year($item->date);
            $month = month($item->date);

            $scheduleMonth = ScheduleMonth::concrete($year, $month, $item->user)->first();

            if (!$scheduleMonth) {
                return;
            }

            Schedule::create([
                'type'              => $item->type,
                'turn_up'           => $item->turn_up,
                'went_away'         => $item->went_away,
                'dinner_break'      => $item->dinner_break,
                'user_id'           => $item->user,
                'schedule_month_id' => $scheduleMonth->id,
                'created_at'        => $item->date,
                'updated_at'        => $item->date,
            ]);
        });
    }
}
