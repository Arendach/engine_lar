<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNewPostCitiesTable extends Migration
{
    public function up()
    {
        Schema::create('new_post_cities', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 128);
            $table->string('ref', 128)->unique();
            $table->string('prefix', 32);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('new_post_cities');
    }
}
