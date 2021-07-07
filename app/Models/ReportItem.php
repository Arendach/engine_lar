<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ReportItem extends Model
{
    /*    protected $fillable = [
            'user_id',
            'just_now',
            'start_month',
            'year',
            'month'
        ];*/

    protected $guarded = [];

    public $timestamps = false;

    public function scopeConcrete(Builder $builder, int $year, int $month, int $user_id): void
    {
        $builder->where('year', $year)->where('month', $month)->where('user_id', $user_id);
    }

    public function items()
    {
        return $this->hasMany(Report::class);
    }

    public function sumMoving()
    {
        return $this->items
            ->where('type', 'moving')
            ->sum(function(Report $report) {
                return $report->sum;
            });

    }

    public function sumToReserve()
    {
        return $this->sumMoving() + $this->items
            ->where('type', 'to_reserve')
            ->sum(function(Report $report) {
                return $report->sum;
            });

    }

    public function sumUnReserve()
    {
        return $this->items
            ->where('type', 'un_reserve')
            ->sum(function(Report $report) {
                return $report->sum;
            });

    }
    public function sumProfits()
    {
        return $this->items
            ->where('type', 'profits')
            ->sum(function(Report $report) {
                return $report->sum;
            });

    }

    public function sumOnHands()
    {
        return $this->start_month + $this->sumProfits() + $this->sumUnReserve() - $this->sumToReserve();

    }


}
