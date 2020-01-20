<?php

namespace App\Services;

use App\Models\ReportItem;
use Illuminate\Support\Collection;

class ReportService
{
    public function getOrCreateOrFail(int $year, int $month, int $user_id)
    {
        $report = ReportItem::concrete($year, $month, $user_id);
        $exists = $report->count();

        if (!$exists and $year != year() and $month != month()) {
            abort(404);
        }

        if (!$exists) {
            $this->create($year, $month, $user_id);
        }

        return $report->first();
    }

    public function create(int $year, int $month, int $user_id)
    {
        ReportItem::create([
            'just_now'    => 0,
            'year'        => $year,
            'month'       => $month,
            'user_id'     => $user_id,
            'start_month' => $this->getPrevMonthSum($user_id)
        ]);
    }

    private function getPrevMonthSum($user_id): float
    {
        $report = ReportItem::where('user_id', $user_id)
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->first();

        if (is_null($report)) {
            return 0;
        }

        return $report->just_now + $report->start_month;
    }
}