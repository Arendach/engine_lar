<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShopsTable extends Migration
{
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 32);
            $table->string('name_ru', 32);
            $table->string('address', 128)->nullable();
            $table->string('address_ru', 128)->nullable();
            $table->string('url', 128);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
