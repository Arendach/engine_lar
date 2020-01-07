<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInventoryProductsTable extends Migration
{
    public function up()
    {
        Schema::create('inventory_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inventory_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('amount');
            $table->integer('previous_amount');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_products');
    }
}
