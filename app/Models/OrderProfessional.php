<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderProfessional
 *
 * @property int $id
 * @property string $name
 * @property string $color
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProfessional newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProfessional newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProfessional query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProfessional whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProfessional whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProfessional whereName($value)
 * @mixin \Eloquent
 */
class OrderProfessional extends Model
{
    protected $table = 'order_professional';

    protected $fillable = [
        'name',
        'color'
    ];

    public $timestamps = false;

}