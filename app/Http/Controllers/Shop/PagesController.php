<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PagesController extends Controller
{
    public function sectionMain(): View
    {
        $pages = Page::orderBy('id', 'desc')->paginate(100);

        return view('shop.pages.main', compact('pages'));
    }

    public function sectionUpdate(int $id): View
    {
        $page = Page::findOrFail($id);

        return view('shop.pages.update', compact('page'));
    }

    public function sectionCreate(): View
    {
        return view('shop.pages.create');
    }

    public function actionUpdate(Request $request): void
    {
        Page::findOrFail($request->id)->update($request->all());
    }

    public function actionCreate(Request $request): JsonResponse
    {
        $page = Page::create($request->all());

        return response()->json([
            'url' => "/shop/pages/update?id={$page->id}"
        ]);
    }

    public function actionDelete(int $id): void
    {
        Page::findOrFail($id)->delete();
    }
}