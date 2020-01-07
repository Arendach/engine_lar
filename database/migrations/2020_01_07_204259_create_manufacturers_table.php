<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateManufacturersTable extends Migration
{
    public function up()
    {
        Schema::create('manufacturers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64);
            $table->string('email', 64)->nullable();
            $table->string('email', 'phone')->nullable();
            $table->string('address', 128)->nullable();
            $table->text('info')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('manufacturers');
    }
}
