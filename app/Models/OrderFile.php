<?php

namespace App\Models;

use App\Traits\File;
use App\Traits\Image;
use Illuminate\Database\Eloquent\Model;

class OrderFile extends Model
{
    use File;
    use Image;

    protected $table = 'order_files';

    protected $guarded = [];
}