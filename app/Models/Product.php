<?php

namespace App\Models;

use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
use App\Casts\ProductAttributesCast;
use App\Casts\ProductName;
use App\Traits\Filterable;
use App\Traits\NumberFormat;
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

    protected $table = 'products';

    protected $fillable = [
        'name',
        'name_ru',
        'articul',
        'model',
        'model_ru',
        'identefire_storage',
        'services_code',
        'count_on_storage',
        'procurement_costs',
        'is_combine',
        'costs',
        'storage',
        'archive',
        'attributes',
        'manufacturer_id',
        'category_id',
        'weight',
        'volume',
        'author_id',
        'date',
        'is_accounted',
        'description',
        'description_ru',
        'meta_title_uk',
        'meta_title_ru',
        'meta_keywords_uk',
        'meta_keywords_ru',
        'meta_description_uk',
        'meta_description_ru',
        'product_key',
    ];

    protected $casts = [
        'attributes'   => ProductAttributesCast::class,
        'is_accounted' => 'boolean'
    ];

    public $timestamps = false;

    public function storage($storage_id)
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
        return $this->belongsToMany(Storage::class, 'product_storage')->withPivot('count');
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
            ->withPivot('combine_price', 'combine_minus');
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
        [$level1] = explode('-', $this->identefire_storage);

        return trim($level1);
    }

    public function getLevel2Attribute(): ?string
    {
        [, $level2] = explode('-', $this->identefire_storage);

        return trim($level2);
    }

    public function getNameAttribute($value): string
    {
        return $this->articul . ' ' . $value;
    }
}