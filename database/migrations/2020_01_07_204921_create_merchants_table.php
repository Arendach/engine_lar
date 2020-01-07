<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMerchantsTable extends Migration
{
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 32);
            $table->string('password', 32);
            $table->string('merchant_id', 32);
        });
    }

    public function down()
    {
        Schema::dropIfExists('merchants');
    }
}
