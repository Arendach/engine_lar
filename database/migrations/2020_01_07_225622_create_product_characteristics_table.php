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

            $table->string('value_uk', 256)->nullable();
            $table->string('value_ru', 256)->nullable();
            $table->string('filter_uk', 256)->nullable();
            $table->string('filter_ru', 256)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_characteristics');
    }
}
