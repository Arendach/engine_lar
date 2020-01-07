<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttributesTable extends Migration
{
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('name_ru', 255);
        });
    }

    public function down()
    {
        Schema::dropIfExists('attributes');
    }
}
