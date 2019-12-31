<?php

namespace App\Models;

use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
use Illuminate\Database\Eloquent\Model;

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
 */
class Product extends Model
{
    protected $table = 'products';

    use EagerLoadPivotTrait;

    public function storage()
    {
        return $this->belongsTo(Storage::class, 'storage_id');
    }

    public function storage_list()
    {
        return $this->hasMany(ProductStorage::class)
            ->orderByDesc('count')
            ->with('storage');
    }

    /**
     * @param static $json
     * @return array
     */
    public function getAttributesAttribute(string $json): array
    {
        $attributes = json_decode(htmlspecialchars_decode($json), true);

        return is_array($attributes) ? $attributes : [];
    }

    public function linked()
    {
        return $this->belongsToMany(Product::class, ProductLinked::class, 'product_id', 'linked_id')
            ->withPivot('combine_price', 'combine_minus');
    }

}