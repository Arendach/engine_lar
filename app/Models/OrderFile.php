<?php

namespace App\Models;

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
    protected $table = 'order_files';

    public function getIconAttribute()
    {
        $extension = mb_strtolower(pathinfo($this->path)['extension']);

        if (in_array($extension, ['png', 'gif', 'jpeg', 'jpg', 'bmp'])) {
            return $this->path;
        } else {
            return asset("images/formats/$extension.png");
        }
    }

    public function getBaseNameAttribute()
    {
        return pathinfo($this->path)['basename'];
    }

    public function getCreateDateAttribute()
    {
        if (!is_file(base_path($this->path))) return '0000.00.00 00:00';

        return date("Y.m.d H:i", filemtime(base_path($this->path)));
    }

    public function getSizeAttribute()
    {
        if (!is_file(base_path($this->path))) return '0 mb';
        return my_file_size(filesize(base_path($this->path)));
    }
}