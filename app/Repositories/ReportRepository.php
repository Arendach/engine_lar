<?php

namespace App\Repositories;

use App\Models\Report;
use App\Models\ReportItem;
use App\Services\ReportService;
use Illuminate\Support\Collection;

class ReportRepository
{
    private $service;
    private $reportItem;
    private $report;

    public function __construct(ReportService $service, ReportItem $reportItem, Report $report)
    {
        $this->service = $service;
        $this->reportItem = $reportItem;
        $this->report = $report;
    }

    public function getOrCreateOrFail(int $year, int $month, int $user_id): ReportItem
    {
        $report = $this->reportItem->concrete($year, $month, $user_id);
        $exists = $report->count();

        if (!$exists and $year != year() and $month != month()) {
            abort(404);
        }

        if (!$exists) {
            $this->service->create($year, $month, $user_id);
        }

        return $report->first()->load('items');
    }

    public function getForUser($user_id): Collection
    {
        return $this->reportItem
            ->where('user_id', $user_id)
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->get()
            ->mapToGroups(function (ReportItem $item) {
                return [$item->year => $item];
            });
    }

    public function getConcreteOrFail(int $year = null, int $month = null, int $user_id = 0): ReportItem
    {
        return $this->reportItem->concrete(year($year), month($month), user($user_id)->id)->firstOrFail();
    }
}