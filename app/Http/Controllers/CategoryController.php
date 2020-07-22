<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryTree;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public $access = 'category';

    public function sectionMain(CategoryTree $categoryTree)
    {
        $categoryTree->forgetCache();

        return view('category.main', [
            'categories' => $categoryTree->table()
        ]);
    }

    public function actionCreateForm(CategoryTree $categoryTree)
    {
        return view('category.create_form', [
            'categories' => $categoryTree->option()
        ]);
    }

    public function actionUpdateForm(Request $request, CategoryTree $categoryTree)
    {
        $data = [
            'categories' => $categoryTree->option(),
            'category' => Category::findOrFail($request->id)
        ];

        return view('category.update_form', $data);
    }

    public function actionCreate(CreateCategoryRequest $request, CategoryTree $categoryTree)
    {
        Category::create($request->validated());

        $categoryTree->forgetCache();
    }

    public function actionUpdate(UpdateCategoryRequest $request, CategoryTree $categoryTree)
    {
        Category::findOrFail($request->get('id'))->update($request->validated());

        $categoryTree->forgetCache();
    }

    public function actionDelete(Request $request, CategoryTree $categoryTree)
    {
        Category::findOrFail($request->id)->delete();

        $categoryTree->forgetCache();

        return response()->json(['message' => 'Дані успішно видалені!']);
    }

    public function apiAll(CategoryTree $categoryTree)
    {
        echo $categoryTree->option();
    }
}