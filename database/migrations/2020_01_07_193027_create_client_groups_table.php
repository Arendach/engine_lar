<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('client_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 256);
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_groups');
    }
}
