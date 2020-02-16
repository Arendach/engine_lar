<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BlackDate
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $date
 * @property string|null $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlackDate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlackDate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlackDate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlackDate whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlackDate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlackDate whereName($value)
 * @mixin \Eloquent
 */
class BlackDate extends Model
{
    protected $table = 'black_dates';

    protected $dates = ['date'];

    protected $fillable = [
        'date',
        'name'
    ];

    public $timestamps = false;
}
