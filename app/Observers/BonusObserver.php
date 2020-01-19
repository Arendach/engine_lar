<?php

namespace App\Observers;

use App\Models\Bonus;
use App\Models\ScheduleMonth;
use App\Services\ScheduleService;

class BonusObserver
{
    public function created(Bonus $bonus)
    {
        $scheduleService = app(ScheduleService::class);

        $scheduleService->create(year($bonus->date), month($bonus->date), $bonus->user_id);

        $schedule = ScheduleMonth::concrete(year($bonus->date), month($bonus->date), $bonus->user_id)->first();

        $schedule->increment($bonus->type, $bonus->sum);
    }

    public function updated(Bonus $bonus)
    {
        //
    }

    public function deleted(Bonus $bonus)
    {
        //
    }

    public function restored(Bonus $bonus)
    {
        //
    }

    public function forceDeleted(Bonus $bonus)
    {
        //
    }
}
