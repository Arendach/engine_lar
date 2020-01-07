<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCharacteristicsTable extends Migration
{
    public function up()
    {
        Schema::create('characteristics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_uk', 64);
            $table->string('name_ru', 64);
            $table->string('prefix_uk', 16);
            $table->string('prefix_ru', 16);
            $table->string('postfix_uk', 16);
            $table->string('postfix_ru', 16);
            $table->string('type', 32);
        });
    }

    public function down()
    {
        Schema::dropIfExists('characteristics');
    }
}
