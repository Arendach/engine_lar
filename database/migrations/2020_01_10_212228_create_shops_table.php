<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShopsTable extends Migration
{
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();

            $table->string('name_uk', 256)->nullable();
            $table->string('name_ru', 256)->nullable();
            $table->string('address_uk', 256)->nullable();
            $table->string('address_ru', 256)->nullable();
            $table->string('url', 256)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
