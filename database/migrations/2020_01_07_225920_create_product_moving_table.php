<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductMovingTable extends Migration
{
    public function up()
    {
        Schema::create('product_movings', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_from_id')->unsigned();
            $table->integer('user_to_id')->unsigned();
            $table->integer('storage_from_id')->unsigned();
            $table->integer('storage_to_id')->unsigned();
            $table->tinyInteger('status')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_movings');
    }
}
