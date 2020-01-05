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
}
