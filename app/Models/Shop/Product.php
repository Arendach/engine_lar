<?php

namespace App\Models\Shop;

use App\Casts\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $guarded = [];

    protected $casts = [
        'name' => Translatable::class
    ];
    public function connection(string $connection): Model
    {
        return parent::connection($connection);
    }
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

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}