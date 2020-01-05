<?php

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        Article::create([
            'title'         => 'Новий модул новин',
            'type'          => 'news',
            'short_content' => 'Рекомендується для ознайомлення',
            'content'       => 'Коментуємо',
            'author_id'     => 1,
            'is_comment'    => 1,
            'priority'      => 0,
            'is_fixed'      => 1,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s')
        ]);
    }
}
