<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 256);
            $table->string('email', 256)->nullable();
            $table->string('phone', 256);
            $table->string('address', 256)->nullable();
            $table->text('info')->nullable();
            $table->integer('client_group_id');
            $table->smallInteger('percentage')->default(1);
            $table->integer('user_id');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
