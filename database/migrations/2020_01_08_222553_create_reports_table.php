<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReportsTable extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name_operation', 128);
            $table->text('data')->nullable();
            $table->decimal('sum', 10, 2)->default(0);
            $table->text('comment')->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('type', 32);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
