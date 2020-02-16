<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\MerchantCard
 *
 * @property int $id
 * @property string $number
 * @property int $merchant_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MerchantCard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MerchantCard newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MerchantCard query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MerchantCard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MerchantCard whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MerchantCard whereNumber($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Merchant $merchant
 */
class MerchantCard extends Model
{
    protected $table = 'merchant_cards';

    protected $fillable = [
        'number',
        'merchant_id'
    ];

    public $timestamps = false;

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }
}
