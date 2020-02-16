<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlackDatesTable extends Migration
{
    public function up()
    {
        Schema::create('black_dates', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('name')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('black_dates');
    }
}
