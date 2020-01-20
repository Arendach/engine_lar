<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ReportItem
 *
 * @property int $id
 * @property int $user_id
 * @property float $just_now
 * @property float $start_month
 * @property string $year
 * @property string $month
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportItem concrete($year, $month, $user_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportItem whereJustNow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportItem whereMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportItem whereStartMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportItem whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportItem whereYear($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Report[] $items
 * @property-read int|null $items_count
 */
class ReportItem extends Model
{
    protected $fillable = [
        'user_id',
        'just_now',
        'start_month',
        'year',
        'month'
    ];

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
