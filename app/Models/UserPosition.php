<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserPosition
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPosition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPosition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPosition query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPosition whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPosition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPosition whereName($value)
 * @mixin \Eloquent
 */
class UserPosition extends Model
{
    protected $table = 'user_positions';

    protected $fillable = [
        'name',
        'description'
    ];

    public $timestamps = false;

}
