<?php

namespace App\Services;

use App\Models\Bonus;

class BonusService
{
    public function addToSchedule(Bonus $bonus): void
    {
        $scheduleService = app(ScheduleService::class);

        $schedule = $scheduleService->create(
            $bonus->created_at->format('Y'),
            $bonus->created_at->format('m'),
            $bonus->user_id
        );

        if ($schedule) {
            $schedule->increment($bonus->type, $bonus->sum);
        }
    }
}