<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserAccess
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $description
 * @property string $name
 * @property string $params
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess whereParams($value)
 * @property-read mixed $array_params
 */
class UserAccess extends Model
{
    protected $table = 'user_access';

    protected $fillable = [
        'description',
        'name',
        'params'
    ];

    public $timestamps = false;

    public function getArrayParamsAttribute(): array
    {
        if (is_null($this->params)) return [];
        if (mb_strlen($this->params) < 5) return [];
        else return json_decode($this->params);
    }
}
