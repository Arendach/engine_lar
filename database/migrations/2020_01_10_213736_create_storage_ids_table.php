<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStorageIdsTable extends Migration
{
    public function up()
    {
        Schema::create('storage_ids', function (Blueprint $table) {
            $table->increments('id');

            $table->string('level1', 32);
            $table->string('level2', 32);
        });
    }

    public function down()
    {
        Schema::dropIfExists('storage_ids');
    }
}
