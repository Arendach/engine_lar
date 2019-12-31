<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductLinked
 *
 * @property int $id
 * @property int $product_id
 * @property int $linked_id
 * @property float|null $combine_price
 * @property int|null $combine_minus
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductLinked newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductLinked newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductLinked query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductLinked whereCombineMinus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductLinked whereCombinePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductLinked whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductLinked whereLinkedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductLinked whereProductId($value)
 * @mixin \Eloquent
 */
class ProductLinked extends Model
{
    protected $table = 'combine_product';
}