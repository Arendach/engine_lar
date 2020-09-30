<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $connection = 'shop';
    protected $guarded = [];

    public function child(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public static function getTreeSelect()
    {
        $categories = self::with('child')->where('parent_id', 0)->get();

        $result = [];
        foreach ($categories as $category) {
            $result[$category->id] = $category->name_uk;

            foreach ($category->child as $child) {
                $result[$child->id] = "&nbsp; &nbsp; &nbsp; {$child->name_uk}";
            }
        }

        return $result;
    }
}