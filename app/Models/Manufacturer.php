<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Manufacturer
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property int $sort
 * @property string $address
 * @property string $info
 * @property int $groupe
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer whereGroupe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer whereSort($value)
 * @mixin \Eloquent
 */
class Manufacturer extends Model
{
    protected $table = 'manufacturers';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'sort',
        'address',
        'info',
        'groupe'
    ];
}