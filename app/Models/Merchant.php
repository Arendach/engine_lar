<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Merchant
 *
 * @property int $id
 * @property string $name
 * @property string $password
 * @property int $merchant_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant wherePassword($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MerchantCard[] $cards
 * @property-read int|null $cards_count
 */
class Merchant extends Model
{
    protected $table = 'merchants';

    protected $fillable = [
        'name',
        'password',
        'merchant_id'
    ];

    public $timestamps = false;

    public function cards(): HasMany
    {
        return $this->hasMany(MerchantCard::class);
    }
}
