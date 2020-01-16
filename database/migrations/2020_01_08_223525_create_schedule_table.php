<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateScheduleTable extends Migration
{
    public function up()
    {
        Schema::create('schedule', function (Blueprint $table) {
            $table->increments('id');

            $table->tinyInteger('type');
            $table->tinyInteger('turn_up')->default(9);
            $table->tinyInteger('went_away')->default(19);
            $table->tinyInteger('work_day')->default(8);
            $table->tinyInteger('dinner_break')->default(1);
            $table->integer('user_id')->unsigned();
            $table->integer('schedule_month_id')->unsigned();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('schedule');
    }
}
