<?php

namespace App\Services;

use App\Models\Category;
use Cache;
use Psr\SimpleCache\InvalidArgumentException;

class CategoryTree
{
    /**
     * @var string
     */
    private $tree = '';

    /**
     * CategoryTree constructor.
     * @throws InvalidArgumentException
     */
    public function __construct()
    {
        $this->boot();
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    private function boot(): void
    {
        if (!Cache::has('category_list_tree')) {
            $this->createTree();
            Cache::set('category_list_tree', $this->tree);
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