<?php

namespace App\Models;

use App\Casts\Checkbox;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pay extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $casts = [
        'is_cashless' => Checkbox::class,
        'is_pdv'      => Checkbox::class
    ];

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }
}