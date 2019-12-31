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

    public function getArrayParamsAttribute($value): array
    {
        if (is_null($value)) return [];
        if (mb_strlen($value) < 5) return [];
        else return json_decode($value);
    }
}
