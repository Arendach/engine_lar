<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', '256');
            $table->enum('type', ['article', 'news']);
            $table->string('short_content');
            $table->longText('content');
            $table->unsignedInteger('author_id');
            $table->boolean('is_comment')->default(true);
            $table->integer('priority')->default(0);
            $table->boolean('is_fixed')->default(false);
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
