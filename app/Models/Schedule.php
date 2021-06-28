<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';

/*    protected $fillable = [
        'date',
        'type',
        'turn_up',
        'went_away',
        'dinner_break',
        'user_id',
        'schedule_month_id'
    ];*/

    protected $guarded = [];

    public $timestamps = true;

    private $types = [
        'holiday'  => 'Вихідний',
        'working'  => 'Робочий',
        'vacation' => 'Відпустка',
        'hospital' => 'Лікарняний'
    ];

    private $type_colors = [
        'holiday'  => '#ff0000',
        'working'  => '#244cff',
        'vacation' => '#0a790f',
        'hospital' => '#ffa500'
    ];

    private $worked_colors = [
        'minus' => '#f00',
        'plus'  => '#0f0',
        'equal' => '#00f'
    ];

    // relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->hasOne(ScheduleType::class);
    }


    // accessor + mutator
    public function getTypeNameAttribute()
    {
        return $this->types[$this->type] ?? null;
    }

    public function getTypeColorAttribute(): string
    {
        return $this->type_colors[$this->type] ?? '#000';
    }

    public function getWorkedAttribute(): int
    {
        return $this->went_away - $this->turn_up - $this->dinner_break;
    }

    public function getRecyclingAttribute(): int
    {
        return $this->worked - 8 > 0 ? $this->worked - $this->work_day : 0;
    }

    public function getWorkedColorAttribute(): string
    {
        if ($this->worked == 8)
            return $this->worked_colors['equal'];
        elseif ($this->worked > 8)
            return $this->worked_colors['plus'];
        else
            return $this->worked_colors['minus'];
    }

    public function getDayAttribute(): int
    {
        return date('d', strtotime($this->date));
    }

    // scopes
    public function scopeIsHoliday(Builder $query): void
    {
        $query->where('type', 0);
    }

    public function scopeIsWorking(Builder $query): void
    {
        $query->where('type', 1);
    }

    public function scopeIsVacation(Builder $query): void
    {
        $query->where('type', 2);
    }

    public function scopeIsHospital(Builder $query): void
    {
        $query->where('type', 3);
    }
}
