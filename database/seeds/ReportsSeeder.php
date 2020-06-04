<?php

use Illuminate\Database\Seeder;
use App\Models\Report;
use App\Models\ReportItem;

class ReportsSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('report_items')->get()->each(function (stdClass $item) {
            ReportItem::create([
                'id'          => $item->id,
                'user_id'     => $item->user,
                'just_now'    => $item->just_now,
                'start_month' => $item->start_month,
                'year'        => $item->year,
                'month'       => $item->month
            ]);
        });

        DB::connection('old')->table('reports')->get()->each(function (stdClass $item) {
            $reportItemId = $this->getReportItemId($item);

            if (!$reportItemId) {
                return;
            }

            Report::create([
                'id'             => $item->id,
                'name_operation' => $item->name_operation,
                'created_at'     => $item->date,
                'updated_at'     => $item->date,
                'data'           => $item->data,
                'sum'            => $item->sum,
                'comment'        => $item->comment,
                'user_id'        => $item->user,
                'type'           => $item->type,
                'report_item_id' => $reportItemId
            ]);
        });
    }

    private function getReportItemId(stdClass $report): ?int
    {
        $item = DB::connection('old')->table('report_items')->where('month', month($report->date))
            ->where('year', year($report->date))
            ->where('user', $report->user)
            ->first();

        return $item ? $item->id : null;
    }
}
