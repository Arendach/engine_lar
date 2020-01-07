<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCombineProductsTable extends Migration
{
    public function up()
    {
        Schema::create('combine_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('linked_id')->unsigned();
            $table->decimal('price', 10,2)->default(0);
            $table->integer('minus')->default(1);
        });
    }

    public function down()
    {
        Schema::dropIfExists('combine_products');
    }
}
