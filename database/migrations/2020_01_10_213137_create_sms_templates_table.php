<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSmsTemplatesTable extends Migration
{
    public function up()
    {
        Schema::create('sms_templates', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 32);
            $table->string('text', 256);
            $table->enum('type', ['delivery', 'self', 'sending'])->default('delivery');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sms_templates');
    }
}