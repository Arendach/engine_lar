<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ReportItem;
use App\Models\Report;

class ReportRelation extends Command
{
    protected $signature = 'report:relation';

    protected $description = 'Command description';

    public function handle()
    {
        $bar = $this->output->createProgressBar(Report::count());

        $bar->start();

        Report::chunk(100, function ($reports) use (&$bar) {
            foreach ($reports as $report) {
                $item = ReportItem::concrete(year($report->created_at), month($report->created_at), $report->user_id)->first();

                $report->report_item_id = $item->id ?? null;

                $report->save();
            }

            $bar->advance(100);
        });

        $bar->finish();
    }
}
