<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderTransaction
 *
 * @property int $id
 * @property int $order_id
 * @property int $transaction_id
 * @property float $sum
 * @property string $date
 * @property string|null $description
 * @property string $card
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderTransaction whereCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderTransaction whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderTransaction whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderTransaction whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderTransaction whereSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderTransaction whereTransactionId($value)
 * @mixin \Eloquent
 */
class OrderTransaction extends Model
{
    //
}
