<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');

            $table->string('login', 32);
            $table->string('password', 32);
            $table->string('email', 64)->nullable();
            $table->string('name', 256);
            $table->string('pin', 3)->default('000');
            $table->decimal('reserve_funds', 10, 2)->default(0);
            $table->decimal('rate', 10, 2)->default(0);
            $table->boolean('schedule_notice')->default(true);
            $table->integer('user_position_id')->nullable()->unsigned();
            $table->boolean('is_courier')->default(true);
            $table->string('theme', 32)->default('flatfly');
            $table->json('access')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
