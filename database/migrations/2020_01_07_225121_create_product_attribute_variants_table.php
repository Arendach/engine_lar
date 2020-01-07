<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductAttributeVariantsTable extends Migration
{
    public function up()
    {
        Schema::create('product_attribute_variants', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('product_attribute_id')->unsigned();
            $table->string('value', 256);
            $table->string('value_ru', 256);
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_attribute_variants');
    }
}
