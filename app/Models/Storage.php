<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Storage
 *
 * @property int $id
 * @property string $name
 * @property int $accounted
 * @property string $info
 * @property int $sort
 * @property int $self
 * @property int $delivery
 * @property int $shop
 * @property int $sending
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereAccounted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereSelf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereSending($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereShop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereSort($value)
 * @mixin \Eloquent
 */
class Storage extends Model
{
    protected $table = 'storage';

}