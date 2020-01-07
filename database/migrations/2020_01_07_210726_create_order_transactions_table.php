<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('order_transactions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('order_id')->unsigned();
            $table->integer('transaction_id')->unsigned();
            $table->decimal('sum', 10, 2);
            $table->text('description')->nullable();
            $table->string('card', 32);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_transactions');
    }
}
