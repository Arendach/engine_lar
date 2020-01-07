<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Purchase
 *
 * @property int $id
 * @property string $date
 * @property int $manufacturer
 * @property int $status
 * @property int $type
 * @property float $prepayment
 * @property float $sum
 * @property string $comment
 * @property int $storage_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereManufacturer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase wherePrepayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereStorageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereType($value)
 * @mixin \Eloquent
 */
class Purchase extends Model
{
    //
}
