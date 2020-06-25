<?php

namespace App\Services;

use App\Models\Schedule;
use App\Models\ScheduleMonth;

class ScheduleService
{
    public function __construct()
    {
        $this->boot();
    }

    private function boot(): void
    {

    }

    public function createOrAbort(int $year, int $month, int $user_id): void
    {
        abort_if(year() != $year || month() != $month, 404);

        $this->create($year, $month, $user_id);
    }

    public function create(int $year, int $month, int $user_id): ScheduleMonth
    {
        if (ScheduleMonth::concrete($year, $month, $user_id)->count()) {
            return ScheduleMonth::concrete($year, $month, $user_id)->first();
        }

        $priceMonth = user($user_id)->rate ?? 0;

        return ScheduleMonth::create([
            'price_month' => $priceMonth,
            'for_car'     => 0,
            'bonus'       => 0,
            'user_id'     => $user_id,
            'year'        => $year,
            'month'       => $month,
            'created_at'  => now(),
            'updated_at'  => now(),
            'fine'        => 0,
            'coefficient' => 1.6
        ]);
    }
}