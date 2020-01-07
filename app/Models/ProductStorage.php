<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ProductStorage
 *
 * @property int $id
 * @property int $product_id
 * @property int $storage_id
 * @property int $count
 * @property-read \App\Models\Storage $storage
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductStorage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductStorage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductStorage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductStorage whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductStorage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductStorage whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductStorage whereStorageId($value)
 * @mixin \Eloquent
 */
class ProductStorage extends Model
{
    use SoftDeletes;

    protected $table = 'product_storage';

    public $timestamps = false;

    public static function getCount($storage_id, $product_id)
    {
        return ProductStorage::select('count')
            ->where('storage_id', $storage_id)
            ->where('product_id', $product_id)
            ->first()
            ->count;
    }

    public function storage()
    {
        return $this->belongsTo(Storage::class, 'storage_id');
    }
}