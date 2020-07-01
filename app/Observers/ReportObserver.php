<?php

namespace App\Observers;

use App\Models\Report;
use App\Services\ReportService;

class ReportObserver
{
    public function creating(Report $report)
    {
        if (!$report->report_item_id) {
            $report->report_item_id = app(ReportService::class)->findOrCreateReportItem()->id;
        }
    }
}