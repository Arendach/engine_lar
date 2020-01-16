<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ScheduleMonth
 *
 * @property int $id
 * @property float $price_month
 * @property float $for_car
 * @property float|null $bonus
 * @property int $user_id
 * @property int $year
 * @property int $month
 * @property string $date
 * @property float|null $fine
 * @property float|null $coefficient
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth whereBonus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth whereCoefficient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth whereFine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth whereForCar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth whereMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth wherePriceMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth whereYear($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth my()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Schedule[] $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleMonth concrete($year = null, $month = null, $user = null)
 */
class ScheduleMonth extends Model
{
    protected $table = 'schedule_month';

    protected $fillable = [
        'price_month',
        'for_car',
        'bonus',
        'user_id',
        'year',
        'month',
        'date',
        'fine',
        'coefficient'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeMy(Builder $query): void
    {
        $query->where('user_id', user()->id);
    }

    public function items()
    {
        return $this->hasMany(Schedule::class);
    }

    public function scopeConcrete(Builder $query, int $year = null, int $month = null, int $user = null)
    {
        if (!is_null($year)) {
            $query->where('year', $year);
        }

        if (!is_null($month)) {
            $query->where('month', $month);
        }

        if (!is_null($user)) {
            $query->where('user_id', $user);
        }
    }
}
