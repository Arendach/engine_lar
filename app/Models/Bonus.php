<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Bonus
 *
 * @property int $id
 * @property string $data
 * @property mixed $type
 * @property float $sum
 * @property int $user_id
 * @property string $date
 * @property string $source
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus whereSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus whereUserId($value)
 * @mixin \Eloquent
 * @property-read mixed $color
 * @property-read mixed $type_text
 * @property-read mixed $date_human
 */
class Bonus extends Model
{
    protected $table = 'bonuses';

    protected $fillable = [
        'data',
        'type',
        'sum',
        'user_id',
        'date',
        'source'
    ];

    protected $dates = ['date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getColorAttribute()
    {
        return $this->type == 'bonus' ? 'rgba(0, 255, 0, 0.1)' : 'rgba(255, 0, 0, 0.1)';
    }

    public function getTypeTextAttribute()
    {
        return $this->type == 'bonus' ? 'Бонус' : 'Штраф';
    }

    public function getDateHumanAttribute()
    {
        return date_for_humans($this->date->format('Y-m-d'));
    }
}