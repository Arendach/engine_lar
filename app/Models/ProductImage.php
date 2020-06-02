<?php

namespace App\Models;

use App\Traits\File;
use App\Traits\Image;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use File, Image;

    protected $table = 'product_images';
/*
    protected $fillable = [
        'product_id',
        'path',
        'alt',
        'deleted_at',
        'created_at',
        'updated_at',
        'is_main'
    ];*/

    protected $guarded = [];

    public $timestamps = true;

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}
