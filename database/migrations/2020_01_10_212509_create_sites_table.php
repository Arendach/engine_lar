<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesTable extends Migration
{
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 32);
            $table->string('url', 128);
            $table->string('key', 32)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sites');
    }
}
