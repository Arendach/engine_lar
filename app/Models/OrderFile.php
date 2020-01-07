<?php

namespace App\Models;

use App\Traits\File;
use App\Traits\Image;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderFile
 *
 * @property int $id
 * @property string $path
 * @property int $order_id
 * @property-read mixed $base_name
 * @property-read mixed $create_date
 * @property-read mixed $icon
 * @property-read mixed $size
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderFile whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderFile wherePath($value)
 * @mixin \Eloquent
 */
class OrderFile extends Model
{
    use File;
    use Image;

    protected $table = 'order_files';
}