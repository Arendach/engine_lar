<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBonusesTable extends Migration
{
    public function up()
    {
        Schema::create('bonuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('data', 1024);
            $table->boolean('is_profit');
            $table->decimal('sum', 10,2);
            $table->integer('user_id')->unsigned();
            $table->string('source', 32);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bonuses');
    }
}
