<?php

namespace App\Models;

use App\Traits\DateHuman;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Inventory
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property int $user_id
 * @property string $comment
 * @property int $manufacturer_id
 * @property int $storage_id
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory whereManufacturerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory whereStorageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory whereUserId($value)
 * @mixin \Eloquent
 * @property-read string $created_date_human
 * @property-read string $updated_date_human
 * @property-read \App\Models\Manufacturer $manufacturer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\Storage $storage
 * @property-read \App\Models\User $user
 */
class Inventory extends Model
{
    use DateHuman;

    protected $table = 'inventory';

    protected $fillable = [
        'user_id',
        'manufacturer_id',
        'storage_id',
        'comment',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;

    protected $dates = ['created_at', 'updated_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function storage(): BelongsTo
    {
        return $this->belongsTo(Storage::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->using(InventoryProduct::class)
            ->withPivot(['old_count', 'amount']);
    }
}
