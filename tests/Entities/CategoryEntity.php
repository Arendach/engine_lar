<?php

namespace Tests\Entities;

use App\Models\Category;

trait CategoryEntity
{
    public $category;

    public function getCategory(): Category
    {
        if (!$this->category) {
            $this->category = factory(Category::class)->create();
        }

        return $this->category;
    }
}