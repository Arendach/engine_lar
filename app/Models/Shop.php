<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Shop
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string|null $name_ru
 * @property string|null $address_ru
 * @property string|null $url_path
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereAddressRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereUrlPath($value)
 * @mixin \Eloquent
 */
class Shop extends Model
{
    protected $table = 'shops';
}