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
}
