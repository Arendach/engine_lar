<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLogisticsTable extends Migration
{
    public function up()
    {
        Schema::create('logistics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64);
        });
    }

    public function down()
    {
        Schema::dropIfExists('logistics');
    }
}
