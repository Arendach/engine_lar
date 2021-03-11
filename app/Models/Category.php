<?php

namespace App\Models;

class Category extends Model
{
    protected $table = 'categories';
    protected $guarded = [];
    public $timestamps = false;

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
