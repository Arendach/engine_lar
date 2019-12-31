<?php

namespace App\Models;

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
 */
class Schedule extends Model
{
    protected $table = 'schedule';

    protected $fillable = [
        'date',
        'type',
        'turn_up',
        'went_away',
        'work_day',
        'dinner_break',
        'user_id'
    ];

    private $types = [
        0 => '',
        1 => '',
        2 => '',
        3 => '',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTypeNameAttribute()
    {
        return $this->types[$this->type] ?? null;
    }
}
