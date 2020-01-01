<?php

namespace App\Services;

use App\Models\Category;
use Cache;

class CategoryTree
{
    /**
     * @var string
     */
    private $tree = '';

    /**
     * CategoryTree constructor.
     */
    public function __construct()
    {
        $this->boot();
    }

    /**
     * @return void
     */
    private function boot(): void
    {
        if (!Cache::has('category_list_tree')) {
            $this->createTree();
            Cache::forever('category_list_tree', $this->tree);
        } else {
            $this->tree = Cache::get('category_list_tree');
        }
    }

    /**
     * @param int $parent_id
     * @param int $level
     */
    private function createTree(int $parent_id = 0, int $level = 0): void
    {
        $level++;
        $categories = Category::where('parent_id', $parent_id)->get();
        foreach ($categories as $category) {
            $space = '';
            for ($i = 1; $i < $level; $i++) $space .= '&emsp;';
            $this->tree .= "<option value='$category->id'>$space $category->name</option>";
            $this->createTree($category->id, $level);
        }
    }

    /**
     * @return string
     */
    public function get(): string
    {
        return $this->tree;
    }
}