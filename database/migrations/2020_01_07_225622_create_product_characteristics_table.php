<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductCharacteristicsTable extends Migration
{
    public function up()
    {
        Schema::create('product_characteristics', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('characteristic_id')->unsigned();
            $table->integer('product_id')->unsigned();

            $table->string('value_uk', 64);
            $table->string('value_ru', 64);
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_characteristics');
    }
}
