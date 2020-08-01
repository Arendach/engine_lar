<?php

namespace App\Models;

use App\Traits\File;
use App\Traits\Image;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{
    use File, Image, SoftDeletes;

    protected $table = 'product_images';
    protected $guarded = [];
}
