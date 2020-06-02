<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductMoving extends Model
{
    protected $guarded = [];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_moving_product')->withPivot('count');
    }

    public function userFrom(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_from_id');
    }

    public function userTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_to_id');
    }

    public function storageFrom(): BelongsTo
    {
        return $this->belongsTo(Storage::class, 'storage_from_id');
    }

    public function storageTo(): BelongsTo
    {
        return $this->belongsTo(Storage::class, 'storage_to_id');
    }
}
