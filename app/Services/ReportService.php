<?php

namespace App\Services;

use App\Models\Report;
use App\Models\ReportItem;

class ReportService
{
    public function create(int $year, int $month, int $user_id): ReportItem
    {
        return ReportItem::create([
            'just_now'    => 0,
            'year'        => $year,
            'month'       => $month,
            'user_id'     => $user_id,
            'start_month' => $this->getPrevMonthSum($user_id)
        ]);
    }

    public function findOrCreateReportItem(int $year = null, int $month = null, int $userId = 0): ReportItem
    {
        $year = year($year);
        $month = month($month);
        $userId = user($userId)->id;

        if (ReportItem::concrete($year, $month, $userId)->count()) {
            return ReportItem::concrete($year, $month, $userId)->first();
        } else {
            return $this->create($year, $month, $userId);
        }
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

    public function createMoving(array $data): void
    {
        $userId = $data['user_id'];
        unset($data['user_id']);

        Report::create(array_merge($data, [
            'data'    => "{$userId}:0",
            'user_id' => user()->id,
            'type'    => 'moving'
        ]));
    }

    public function closeMoving(int $reportId, array $data): void
    {
        $report = Report::findOrFail($reportId);

        $report->update([
            'data' => preg_replace('~0$~', '1', $report->data)
        ]);

        $newReport = Report::create([
            'name_operation' => $data['name_operation'],
            'data'           => $report->user_id,
            'sum'            => $report->sum,
            'comment'        => $data['comment'],
            'user_id'        => user()->id,
            'type'           => 'moving_to',
            'report_item_id' => $this->findOrCreateReportItem()->id
        ]);

        $this->reset($report->id);
        $this->reset($newReport->id);
    }

    public function createExpenditures(array $data): void
    {
        $dataString = collect($data['data'])->mapWithKeys(function (string $field) use ($data) {
            return "{$field}:{$data[$field]}";
        })->pluck('key')->implode("\n");

        $report = Report::create(array_merge($data, [
            'data' => $dataString,
            'type' => 'expenditures'
        ]));

        $this->reset($report->id);
    }

    private function reset(int $reportId): void
    {
        $report = Report::find($reportId);

        if (!$report) {
            return;
        }

        $reportItem = $this->findOrCreateReportItem(
            $report->created_at->format('Y'),
            $report->created_at->format('m'),
            $report->user_id
        )->load('items');

        $sum = $reportItem->items->sum(function (Report $report) {
            if ($report->type == 'moving') {
                return preg_match('~0$~', $report->data) ? 0 : -1 * abs($report->sum);
            }

            if ($report->isProfit()) {
                return abs($report->sum);
            }

            if ($report->isExpenditures()) {
                return -1 * abs($report->sum);
            }

            return 0;
        });

        $month = month_valid($reportItem->month);
        if ("{$reportItem->year}{$month}" != date('Ym') and $reportItem->just_now != $sum) {
            $this->createFromPreviousMonths($sum - $reportItem->just_now, $report->user_id);
        }

        $reportItem->update([
            'just_now' => $sum
        ]);
    }

    private function createFromPreviousMonths(float $sum, int $userId = 0): void
    {
        $report = Report::create([
            'name_operation' => 'Зарахована різниця з попередіх місяців',
            'data'           => null,
            'sum'            => $sum,
            'comment'        => 'Створено автоматично! Зарахування різниці в звіті за попередні місяці',
            'user_id'        => user($userId)->id,
            'type'           => 'from_previous_month',
            'report_item_id' => $this->findOrCreateReportItem()->id
        ]);

        $this->reset($report->id);
    }
}