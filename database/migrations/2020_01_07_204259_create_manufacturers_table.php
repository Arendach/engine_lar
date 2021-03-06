<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateManufacturersTable extends Migration
{
    public function up()
    {
        Schema::create('manufacturers', function (Blueprint $table) {
            $table->id();
            $table->string('name_uk', 256)->nullable();
            $table->string('name_ru', 256)->nullable();
            $table->string('email', 256)->nullable();
            $table->string('phone', 256)->nullable();
            $table->string('address', 256)->nullable();
            $table->text('info')->nullable();
            $table->string('image', 256)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('manufacturers');
    }
}
