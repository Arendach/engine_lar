<?php

namespace App\Models;

use App\Traits\DateHuman;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductAsset extends Model
{
    use DateHuman;

    protected $table = 'product_assets';

    protected $guarded = [];

    public function storage(): BelongsTo
    {
        return $this->belongsTo(Storage::class)->withDefault();
    }
}
