<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductMovingProductsTable extends Migration
{
    public function up()
    {
        Schema::create('product_moving_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('product_moving_id')->unsigned();
            $table->integer('count')->unsigned();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_moving_products');
    }
}
