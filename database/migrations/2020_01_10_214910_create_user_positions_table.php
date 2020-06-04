<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserPositionsTable extends Migration
{
    public function up()
    {
        Schema::create('user_positions', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 256);
            $table->longText('description');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_positions');
    }
}
