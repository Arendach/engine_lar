<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Pay
 *
 * @property int $id
 * @property string $name
 * @property int|null $merchant_id
 * @property string|null $provider
 * @property string|null $address
 * @property string|null $ipn
 * @property string|null $account
 * @property string|null $bank
 * @property string|null $mfo
 * @property string|null $phone
 * @property string|null $director
 * @property int|null $is_cashless
 * @property int $is_pdv
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay whereBank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay whereDirector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay whereIpn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay whereIsCashless($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay whereIsPdv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay whereMfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pay whereProvider($value)
 * @mixin \Eloquent
 */
class Pay extends Model
{
    protected $table = 'pays';
}