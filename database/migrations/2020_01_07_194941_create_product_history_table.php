<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductHistoryTable extends Migration
{
    public function up()
    {
        Schema::create('product_history', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('product_id')->unsigned();
            $table->string('type', 32);
            $table->text('data');
            $table->integer('user_id');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_history');
    }
}
