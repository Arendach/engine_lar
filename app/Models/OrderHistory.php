<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\OrderHistory
 *
 * @property int $id
 * @property string|null $data
 * @property int|null $order_id
 * @property string|null $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property int $author_id
 * @property-read \App\Models\User $author
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory whereType($value)
 * @mixin \Eloquent
 */
class OrderHistory extends Model
{
    protected $table = 'order_history';

    protected $fillable = [
        'data',
        'order_id',
        'type',
        'created_at',
        'author_id',
    ];

    protected $dates = ['created_at'];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public $timestamps = false;

}