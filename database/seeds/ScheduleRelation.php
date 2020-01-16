<?php

use Illuminate\Database\Seeder;
use App\Models\ScheduleMonth;
use App\Models\Schedule;

class ScheduleRelation extends Seeder
{
    public function run()
    {
        foreach (Schedule::all() as $schedule) {
            $scheduleMonth = ScheduleMonth::where('user_id', $schedule->user_id)
                ->where('year', date('Y', strtotime($schedule->date)))
                ->where('month', date('m', strtotime($schedule->date)))
                ->first();

            $schedule->schedule_month_id = $scheduleMonth->id ?? null;

            $schedule->save();
        }
    }
}
