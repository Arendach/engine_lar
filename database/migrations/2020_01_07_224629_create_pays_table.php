<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaysTable extends Migration
{
    public function up()
    {
        Schema::create('pays', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 32);
            $table->integer('merchant_id')->unsigned()->nullable();
            $table->string('provider', 128)->nullable();
            $table->string('address', 128)->nullable();
            $table->string('ipn', 128)->nullable();
            $table->string('ipn', 128)->nullable();
            $table->string('account', 128)->nullable();
            $table->string('bank', 128)->nullable();
            $table->string('mfo', 128)->nullable();
            $table->string('phone', 128)->nullable();
            $table->string('director', 128)->nullable();
            $table->boolean('is_cashless')->default(false);
            $table->boolean('is_pdv')->default(false);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pays');
    }
}
