<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('categories')->get()->each(function (stdClass $category) {
            Category::create([
                'id'           => $category->id,
                'name'         => htmlspecialchars_decode($category->name),
                'parent_id'    => $category->parent,
                'priority'     => $category->sort,
                'service_code' => $category->service_code,
            ]);
        });
    }
}
