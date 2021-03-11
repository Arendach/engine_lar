<?php

namespace Tests\Entities;

use App\Models\Category;

trait CategoryEntity
{
    public $category;

    public function getCategory(): Category
    {
        if (!$this->category) {
            $this->category = Category::factory()->create();
        }

        return $this->category;
    }
}