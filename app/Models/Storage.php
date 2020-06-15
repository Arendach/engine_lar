<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Storage extends Model
{
    use SoftDeletes;

    protected $table = 'storage';
    protected $guarded = [];
    public $timestamps = false;
}