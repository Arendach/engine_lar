<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductLinked extends Model
{
    protected $table = 'product_linked';

    public $timestamps = false;

    protected $guarded = [];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function linked(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'linked_id');
    }
}