<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderHintsTable extends Migration
{
    public function up()
    {
        Schema::create('order_hints', function (Blueprint $table) {
            $table->increments('id');
            $table->string('color', 32);
            $table->string('description', 256);
            $table->set('type', ['delivery', 'self', 'sending', 0])->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_hints');
    }
}
