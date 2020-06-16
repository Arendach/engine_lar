<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNewPostWarehousesTable extends Migration
{
    public function up()
    {
        Schema::create('new_post_warehouses', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 128);
            $table->string('ref', 128)->unique();
            $table->string('city_ref', 128);
            $table->integer('city_id')->unsigned();
            $table->integer('number');
            $table->integer('max_weight_place')->nullable()->default(0);
            $table->integer('max_weight_all')->nullable()->default(0);
            $table->string('phone', 32)->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('new_post_warehouses');
    }
}
