<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function sectionList()
    {
        $articles = Article::all();

        $data = [
            'articles' => $articles
        ];

        return view('article.list', $data);
    }

    public function sectionMain()
    {
        return view('article.main');
    }

    public function actionAll()
    {
        return Article::all();
    }

    public function actionCreate(Request $request)
    {
        Article::create($request->all());
    }

    public function actionDelete(int $id)
    {
        // Article::findOrFail($id)->delete();

        return response(1, 200);
    }
}
