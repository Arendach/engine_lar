<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAsset extends Model
{
    use SoftDeletes;

    protected $table = 'product_assets';
    protected $guarded = [];

    public function storage(): BelongsTo
    {
        return $this->belongsTo(Storage::class)->withDefault();
    }
}
