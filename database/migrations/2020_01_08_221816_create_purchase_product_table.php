<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePurchaseProductTable extends Migration
{
    public function up()
    {
        Schema::create('purchase_product', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('product_id')->unsigned();
            $table->integer('purchase_id')->unsigned();
            $table->integer('amount')->unsigned();
            $table->decimal('price', 10, 2)->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('purchase_product');
    }
}
