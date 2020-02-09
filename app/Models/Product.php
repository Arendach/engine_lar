<?php

namespace App\Models;

use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property string|null $name_ru
 * @property string $articul
 * @property string $model
 * @property string|null $model_ru
 * @property string $identefire_storage
 * @property string $services_code
 * @property int $count_on_storage
 * @property float $procurement_costs
 * @property int $combine
 * @property float $costs
 * @property \App\Models\Storage $storage
 * @property int $archive
 * @property array $attributes
 * @property int|null $manufacturer
 * @property int|null $category
 * @property float|null $weight
 * @property string|null $volume
 * @property int $author
 * @property string $date
 * @property int $accounted
 * @property string|null $description
 * @property string|null $description_ru
 * @property string|null $meta_title_uk
 * @property string|null $meta_title_ru
 * @property string|null $meta_keywords_uk
 * @property string|null $meta_keywords_ru
 * @property string|null $meta_description_uk
 * @property string|null $meta_description_ru
 * @property string $product_key
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $linked
 * @property-read int|null $linked_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductStorage[] $storage_list
 * @property-read int|null $storage_list_count
 * @method static \AjCastro\EagerLoadPivotRelations\EagerLoadPivotBuilder|\App\Models\Product newModelQuery()
 * @method static \AjCastro\EagerLoadPivotRelations\EagerLoadPivotBuilder|\App\Models\Product newQuery()
 * @method static \AjCastro\EagerLoadPivotRelations\EagerLoadPivotBuilder|\App\Models\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereAccounted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereArchive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereArticul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereAttributes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCombine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCosts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCountOnStorage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereIdentefireStorage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereManufacturer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereMetaDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereMetaDescriptionUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereMetaKeywordsRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereMetaKeywordsUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereMetaTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereMetaTitleUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereModelRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProcurementCosts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereServicesCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereStorage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereVolume($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereWeight($value)
 * @mixin \Eloquent
 * @property int $is_combine
 * @property int|null $manufacturer_id
 * @property int|null $category_id
 * @property int $author_id
 * @property int $is_accounted
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereIsAccounted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereIsCombine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereManufacturerId($value)
 * @property-read mixed $volume_array
 * @property-read mixed $volume_general
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductImage[] $images
 * @property-read int|null $images_count
 * @property-read mixed $level1
 * @property-read mixed $level2
 * @property-read \App\Models\ProductImage $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Storage[] $storages
 * @property-read int|null $storages_count
 */
class Product extends Model
{
    use EagerLoadPivotTrait;

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

    public $timestamps = false;

    public function storage()
    {
        return $this->belongsTo(Storage::class, 'storage_id');
    }

    public function storage_list(): HasMany
    {
        return $this->hasMany(ProductStorage::class)
            ->orderByDesc('count')
            ->with('storage');
    }

    public function storages()
    {
        return $this->belongsToMany(Storage::class, 'product_storage');
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

    public function getAttributesAttribute(string $json): array
    {
        $attributes = json_decode(htmlspecialchars_decode($json), true);

        return is_array($attributes) ? $attributes : [];
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

}