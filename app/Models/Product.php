<?php

namespace App\Models;

use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
use App\Casts\ProductAttributesCast;
use App\Casts\ProductName;
use App\Casts\Translatable;
use App\Services\ProductHistoryService;
use App\Traits\Editable;
use App\Traits\Filterable;
use App\Traits\NumberFormat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use EagerLoadPivotTrait;
    use Filterable;
    use NumberFormat;
    use Editable;

    protected $table = 'products';

    protected $guarded = [];

    protected $casts = [
        'attributes'       => ProductAttributesCast::class,
        'is_accounted'     => 'boolean',
        'name'             => ProductName::class,
        'model'            => Translatable::class,
        'meta_description' => Translatable::class,
        'meta_keywords'    => Translatable::class,
        'meta_title'       => Translatable::class,
    ];

    public $timestamps = false;

    public function storage($storage_id): ?Storage
    {
        return $this->storages->where('id', $storage_id)->first();
    }

    public function storage_list(): HasMany
    {
        return $this->hasMany(ProductStorage::class)
            ->orderByDesc('count')
            ->with('storage');
    }

    public function storages()
    {
        return $this->belongsToMany(Storage::class, 'product_storage')->withPivot('id', 'count');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function image(): HasOne
    {
        return $this->hasOne(ProductImage::class)
            ->where('is_main', 1);
    }

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function linked(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, ProductLinked::class, 'product_id', 'linked_id')
            ->withPivot('price', 'minus');
    }

    public function getVolumeArrayAttribute(): array
    {
        if (is_null($this->volume) || $this->volume == '' || $this->volume == '[]') return [0, 0, 0];
        else return json_decode($this->volume);
    }

    public function getVolumeGeneralAttribute(): float
    {
        $volume = $this->volume_array;

        return $volume[0] * $volume[1] * $volume[2] / 1000000;
    }

    public function getLevel1Attribute(): ?string
    {
        [$level1] = explode('-', $this->id_storage);

        return trim($level1);
    }

    public function getLevel2Attribute(): ?string
    {
        [, $level2] = explode('-', $this->id_storage);

        return trim($level2);
    }

    public function getUrlAttribute(): string
    {
        return uri('product/update', ['id' => $this->id]);
    }

    public function withHistory(): ProductHistoryService
    {
        return app(ProductHistoryService::class)->setProduct($this);
    }

    public function scopeSearch(Builder $builder, string $query): void
    {
        $builder->where('name_uk', 'like', "%$query%")
            ->where('name_ru', 'like', "%$query%")
            ->orWhere('service_code', 'like', "%$query%")
            ->orWhere('article', 'like', "%$query%")
            ->orWhere('model_uk', 'like', "%$query%")
            ->orWhere('name_ru', 'like', "%$query%");
    }
}