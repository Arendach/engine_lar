<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 256);
            $table->integer('parent_id');
            $table->integer('sort');
            $table->integer('service_code');
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
