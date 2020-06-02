<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStorageTable extends Migration
{
    public function up()
    {
        Schema::create('storage', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 256);
            $table->boolean('is_accounted')->default(true);
            $table->text('info')->nullable();
            $table->boolean('is_delivery')->default(true);
            $table->boolean('is_self')->default(true);
            $table->boolean('is_sending')->default(true);
            $table->integer('priority')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('storage');
    }
}
