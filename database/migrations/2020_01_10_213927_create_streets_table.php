<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStreetsTable extends Migration
{
    public function up()
    {
        Schema::create('streets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('city', 32);
            $table->string('district', 32);
            $table->string('street_type', 32);
            $table->string('name', 32);
        });
    }

    public function down()
    {
        Schema::dropIfExists('streets');
    }
}
