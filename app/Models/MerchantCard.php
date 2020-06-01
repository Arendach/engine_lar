<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MerchantCard extends Model
{
    protected $table = 'merchant_cards';
    protected $guarded = [];
    public $timestamps = false;

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }
}
