<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage accounted($isAccounted = true)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage sort($order = 'asc')
 * @property int $is_accounted
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereIsAccounted($value)
 */
class Storage extends Model
{
    protected $table = 'storage';

    /**
     * @param Builder $query
     * @param string $order
     */
    public function scopeSort(Builder $query, string $order = 'asc'): void
    {
        $query->where('sort', $order);
    }

    public function scopeAccounted(Builder $query, bool $isAccounted = true): void
    {
        $query->where('is_accounted', (int)$isAccounted);
    }
}