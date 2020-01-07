<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderHistoryTable extends Migration
{
    public function up()
    {
        Schema::create('order_history', function (Blueprint $table) {
            $table->increments('id');

            $table->text('data');
            $table->integer('oder_id')->unsigned();
            $table->string('type', 64);
            $table->integer('user_id');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_history');
    }
}
