<?php

namespace App\Models\Shop;

use App\Casts\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $guarded = [];

    protected $casts = [
        'name' => Translatable::class
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getUrlAttribute(): string
    {
        return $this->getUrl("product/{$this->slug}");
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->article} {$this->name}";
    }
}