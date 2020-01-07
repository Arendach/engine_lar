<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderProductTable extends Migration
{
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('storage_id')->unsigned();

            $table->text('attributes')->nullable();
            $table->integer('amount')->default(1);
            $table->decimal('price', 10, 2)->default(0);
            $table->tinyInteger('place')->default(1);
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_product');
    }
}
