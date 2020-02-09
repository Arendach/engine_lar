<?php

namespace App\Models;

use App\Traits\DateHuman;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ProductAsset
 *
 * @property int $id
 * @property string $name
 * @property int $storage_id
 * @property float $price
 * @property \Illuminate\Support\Carbon $created_at
 * @property float $course
 * @property int $is_archive
 * @property string $id_in_storage
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Storage $storage
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAsset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAsset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAsset query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAsset whereCourse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAsset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAsset whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAsset whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAsset whereIdInStorage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAsset whereIsArchive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAsset whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAsset wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAsset whereStorageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAsset whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read string $created_date_human
 * @property-read string $updated_date_human
 */
class ProductAsset extends Model
{
    use DateHuman;

    protected $table = 'product_assets';

    protected $fillable = [
        'name',
        'storage_id',
        'price',
        'created_at',
        'updated_at',
        'is_archive',
        'course',
        'id_in_storage',
        'description'
    ];

    public function storage(): BelongsTo
    {
        return $this->belongsTo(Storage::class)->withDefault();
    }
}
