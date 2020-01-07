<?php

namespace App\Services;

use App\Models\Category;
use Cache;
use Throwable;

class CategoryTree
{
    /**
     * @var string
     */
    private $OptionTree = '';

    /**
     * @var string
     */
    private $TableTree = '';

    /**
     * CategoryTree constructor.
     * @throws Throwable
     */
    public function __construct()
    {
        $this->boot();
    }

    /**
     * @throws Throwable
     */
    private function boot(): void
    {
        if (!Cache::has('category_option_tree') || !Cache::has('category_table_tree')) {
            $this->createTree();
            Cache::forever('category_option_tree', $this->OptionTree);
            Cache::forever('category_table_tree', $this->TableTree);
        } else {
            $this->OptionTree = Cache::get('category_option_tree');
            $this->TableTree = Cache::get('category_table_tree');
        }
    }

    /**
     * @param int $parent_id
     * @param int $level
     * @throws Throwable
     */
    private function createTree(int $parent_id = 0, int $level = 0): void
    {
        $items = Category::where('parent_id', $parent_id)->get();

        $space = '';
        for ($i = 0; $i <= $level; $i++)
            $space .= '&emsp;';

        foreach ($items as $item) {
            $this->TableTree .= view('category.item', compact('item', 'space'))->render();
            $this->OptionTree .= "<option value='$item->id'>$space $item->name</option>";

            if (Category::where('parent_id', $item->id)->count()) {
                $this->createTree($item->id, $level + 1);
            }
        }
    }

    /**
     * @return string
     */
    public function option(): string
    {
        return $this->OptionTree;
    }

    /**
     * @return string
     */
    public function table(): string
    {
        return $this->TableTree;
    }

    public function forgetCache()
    {
        Cache::forget('category_option_tree');
        Cache::forget('category_table_tree');
    }
}