<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMerchantCardsTable extends Migration
{
    public function up()
    {
        Schema::create('merchant_cards', function (Blueprint $table) {
            $table->increments('id');

            $table->string('number', 32);
            $table->integer('merchant_id')->unsigned();
        });
    }

    public function down()
    {
        Schema::dropIfExists('merchant_cards');
    }
}
