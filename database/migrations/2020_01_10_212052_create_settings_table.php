<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');

            $table->string('key', 256);
            $table->text('value')->nullable();
            $table->string('type')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
