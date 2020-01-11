<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSmsMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('sms_messages', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('order_id')->unsigned();
            $table->text('text');
            $table->string('message_id', 32);
            $table->string('phone', 13);
            $table->string('status', 32)->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sms_messages');
    }
}
