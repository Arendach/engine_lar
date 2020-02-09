<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductStorage onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductStorage whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductStorage withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductStorage withoutTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductStorage filter($storage_id, $product_id)
 */
class ProductStorage extends Model
{
    use SoftDeletes;

    protected $table = 'product_storage';

    protected $fillable = [
        'product_id',
        'storage_id',
        'count',
        'deleted_at'
    ];

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

    public function scopeFilter(Builder $builder, int $storage_id, int $product_id): void
    {
        $builder->where('storage_id', $storage_id)->where('product_id', $product_id);
    }
}