<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBonusesTable extends Migration
{
    public function up()
    {
        Schema::create('bonuses', function (Blueprint $table) {
            $table->id();
            $table->string('data', 1024)->nullable();
            $table->boolean('is_profit')->default(true);
            $table->decimal('sum', 10, 2)->default(0);
            $table->integer('user_id')->unsigned();
            $table->string('source', 32)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bonuses');
    }
}
