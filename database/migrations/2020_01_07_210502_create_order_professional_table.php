<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderProfessionalTable extends Migration
{
    public function up()
    {
        Schema::create('order_professional', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64);
            $table->string('color', 6);
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_professional');
    }
}
