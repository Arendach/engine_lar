<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSmsTemplatesTable extends Migration
{
    public function up()
    {
        Schema::create('sms_templates', function (Blueprint $table) {
            $table->id();

            $table->string('name', 256);
            $table->string('text', 1024);
            $table->enum('type', ['delivery', 'self', 'sending'])->default('delivery');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sms_templates');
    }
}
