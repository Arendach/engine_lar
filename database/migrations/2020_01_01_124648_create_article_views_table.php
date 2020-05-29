<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticleViewsTable extends Migration
{
    public function up()
    {
        Schema::create('article_views', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('article_id')->unsigned();
            $table->boolean('is_viewed')->default(false);
            $table->timestamps();

            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('article_id')->references('id')->on('articles');
        });
    }

    public function down()
    {
        Schema::dropIfExists('article_views');
    }
}
