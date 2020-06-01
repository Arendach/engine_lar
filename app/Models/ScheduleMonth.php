<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScheduleMonth extends Model
{
    protected $table = 'schedule_months';

/*    protected $fillable = [
        'price_month',
        'for_car',
        'bonus',
        'user_id',
        'year',
        'month',
        'date',
        'fine',
        'coefficient'
    ];*/

    protected $guarded = [];

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

    // Кількість пропрацьованих годин за місяць
    public function getWorkingHoursAttribute(): ?int
    {
        return $this->items->where('type', 'working')->count() * 8;
    }

    // кількість перепрацьованих годин за місяць
    public function getUpWorkingHoursAttribute(): int
    {
        return $this->items->where('type', 'working')->sum(function (Schedule $item) {
            return $item->worked > 8 ? $item->worked - 8 : 0;
        });
    }

    // кількість годин у відпустці
    public function getVacationHoursAttribute()
    {
        return $this->items->where('type', 'vacation')->count() * 8;
    }

    // кількість дікарняних годин
    public function getHospitalHoursAttribute(): int
    {
        return $this->items->where('type', 'hospital')->count() * 8;
    }

    // Ціна роботи за 1 годину
    public function getHourPriceAttribute()
    {
        return $this->price_month / count_working_days($this->year, $this->month) / 8;

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
