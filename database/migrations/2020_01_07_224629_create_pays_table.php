<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaysTable extends Migration
{
    public function up()
    {
        Schema::create('pays', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 256);
            $table->integer('merchant_id')->unsigned()->nullable();
            $table->string('provider', 256)->nullable();
            $table->string('address', 256)->nullable();
            $table->string('ipn', 256)->nullable();
            $table->string('account', 256)->nullable();
            $table->string('bank', 256)->nullable();
            $table->string('mfo', 256)->nullable();
            $table->string('phone', 256)->nullable();
            $table->string('director', 256)->nullable();
            $table->boolean('is_cashless')->default(false);
            $table->boolean('is_pdv')->default(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('pays');
    }
}
