<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateScheduleMonthTable extends Migration
{
    public function up()
    {
        Schema::create('schedule_months', function (Blueprint $table) {
            $table->id();

            $table->decimal('price_month', 10, 2)->default(0);
            $table->decimal('for_car', 10, 2)->default(0);
            $table->decimal('bonus', 10, 2)->default(0);
            $table->decimal('fine', 10, 2)->default(0);
            $table->decimal('coefficient', 10, 2)->default(1.00);
            $table->integer('user_id')->unsigned();
            $table->integer('year')->unsigned();
            $table->integer('month')->unsigned();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('schedule_months');
    }
}
