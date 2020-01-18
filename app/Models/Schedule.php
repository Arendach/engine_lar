<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Schedule
 *
 * @property int $id
 * @property string $date
 * @property int $type
 * @property int $turn_up
 * @property int $went_away
 * @property int $work_day
 * @property int $dinner_break
 * @property int $user_id
 * @property-read mixed $type_name
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereDinnerBreak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereTurnUp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereWentAway($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereWorkDay($value)
 * @mixin \Eloquent
 * @property int|null $schedule_month_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereScheduleMonthId($value)
 * @property-read mixed $day
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule isHoliday()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule isHospital()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule isVacation()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule isWorking()
 * @property-read mixed $type_color
 * @property-read mixed $worked
 * @property-read mixed $worked_color
 * @property string|null $updated_at
 * @property string|null $created_at
 * @property-read mixed $recycling
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereUpdatedAt($value)
 */
class Schedule extends Model
{
    protected $table = 'schedule';

    protected $fillable = [
        'date',
        'type',
        'turn_up',
        'went_away',
        'dinner_break',
        'user_id',
        'schedule_month_id'
    ];

    public $timestamps = false;

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
