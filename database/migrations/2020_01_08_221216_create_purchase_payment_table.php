<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePurchasePaymentTable extends Migration
{
    public function up()
    {
        Schema::create('purchase_payments', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->integer('purchase_id')->unsigned();
            $table->decimal('sum', 10, 2)->default(0);
            $table->decimal('course', 10, 2)->default(1);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('purchase_payments');
    }
}
