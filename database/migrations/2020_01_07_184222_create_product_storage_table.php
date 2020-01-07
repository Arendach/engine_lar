<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductStorageTable extends Migration
{
    public function up()
    {
        Schema::create('product_storage', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('product_id')->unsigned();
            $table->integer('storage_id')->unsigned();
            $table->integer('count');

            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_storage');
    }
}
