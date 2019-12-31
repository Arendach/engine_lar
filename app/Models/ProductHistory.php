<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductHistory
 *
 * @property int $id
 * @property int|null $product
 * @property string|null $type
 * @property string|null $data
 * @property string|null $date
 * @property int $author
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductHistory whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductHistory whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductHistory whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductHistory whereProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductHistory whereType($value)
 * @mixin \Eloquent
 */
class ProductHistory extends Model
{
    protected $table = 'history_product';

    public $timestamps = false;
}