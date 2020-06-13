<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Merchant extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function cards(): HasMany
    {
        return $this->hasMany(MerchantCard::class);
    }
}
