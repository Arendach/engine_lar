<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReportItemsTable extends Migration
{
    public function up()
    {
        Schema::create('report_items', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->decimal('just_now', 10, 2)->default(0);
            $table->decimal('start_month', 10, 2)->default(0);
            $table->string('year', 4);
            $table->string('month', 2);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('report_items');
    }
}
