<?php

namespace App\Models;

use App\Traits\DateHuman;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Purchase
 *
 * @property int $id
 * @property int $manufacturer_id
 * @property int $status
 * @property int $type
 * @property float $prepayment
 * @property float $sum
 * @property string $comment
 * @property int $storage_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereManufacturerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase wherePrepayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereStorageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read string $created_date_human
 * @property-read mixed $status_name
 * @property-read mixed $type_name
 * @property-read string $updated_date_human
 * @property-read \App\Models\Manufacturer $manufacturer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\Storage $storage
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase filter($filters)
 * @property-read mixed $is_closed
 */
class Purchase extends Model
{
    use DateHuman;
    use Filterable;

    protected $table = 'purchases';

    protected $fillable = [
        'manufacturer_id',
        'status',
        'type',
        'prepayment',
        'sum',
        'comment',
        'storage_id',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    private $statuses = [
        0 => 'Не оплачено',
        1 => 'Сплачено частково',
        2 => 'Сплачено'
    ];

    private $types = [
        0 => 'Потрібно закупити',
        1 => 'Прийнято на облік'
    ];

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
        return $this->belongsToMany(Product::class, 'purchase_product')->withPivot(['amount', 'price']);
    }

    public function payments()
    {
        return $this->hasMany(PurchasePayment::class);
    }

    public function getStatusNameAttribute(): string
    {
        return $this->statuses[$this->status] ?? '';
    }

    public function getTypeNameAttribute(): string
    {
        return $this->types[$this->type] ?? '';
    }

    public function getIsClosedAttribute(): bool
    {
        return $this->status == 2 && $this->type == 1;
    }
}
