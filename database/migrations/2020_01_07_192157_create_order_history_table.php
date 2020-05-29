<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderHistoryTable extends Migration
{
    public function up()
    {
        Schema::create('order_history', function (Blueprint $table) {
            $table->increments('id');

            $table->text('data')->nullable();
            $table->integer('order_id')->unsigned();
            $table->string('type', 64);
            $table->integer('user_id')->unsigned();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_history');
    }
}
