<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductStorage extends Model
{
    use SoftDeletes;

    protected $table = 'product_storage';

    protected $guarded = [];

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