<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserAccessTable extends Migration
{
    public function up()
    {
        Schema::create('user_access', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 256);
            $table->string('description', 256)->nullable();
            $table->json('params');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_access');
    }
}
