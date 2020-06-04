<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStreetsTable extends Migration
{
    public function up()
    {
        Schema::create('streets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('city', 256);
            $table->string('district', 256);
            $table->string('street_type', 256);
            $table->string('name', 256);
        });
    }

    public function down()
    {
        Schema::dropIfExists('streets');
    }
}
