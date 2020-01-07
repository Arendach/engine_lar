<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderFilesTable extends Migration
{
    public function up()
    {
        Schema::create('order_files', function (Blueprint $table) {
            $table->increments('id');

            $table->string('path', 1024);
            $table->integer('user_id')->unsigned();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_files');
    }
}
