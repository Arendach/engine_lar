<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePayoutsTable extends Migration
{
    public function up()
    {
        Schema::create('payouts', function (Blueprint $table) {
            $table->increments('id');

            $table->decimal('sum', 10, 2);
            $table->integer('user_id')->unsigned();
            $table->integer('author_id')->unsigned();
            $table->integer('year');
            $table->integer('month');
            $table->text('comment')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payouts');
    }
}
