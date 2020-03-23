<?php

namespace App\Observers;

use App\Models\Article;

class ArticleObserver
{
    public function creating(Article $article)
    {
        if (is_null($article->author_id)) {
            $article->author_id = user()->id;
        }
    }
}
