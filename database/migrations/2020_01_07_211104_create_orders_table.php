<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            $table->set('type', ['delivery', 'self', 'sending']);
            $table->tinyInteger('status')->default(0);

            // contacts
            $table->string('fio', 64);
            $table->string('phone', 13);
            $table->string('phone2', 13)->nullable();
            $table->string('email', 64)->nullable();

            // address
            $table->string('city', 128)->nullable();
            $table->string('address', 256)->nullable();
            $table->string('street', 256)->nullable();
            $table->string('comment_address', 1024)->nullable();
            $table->string('warehouse', 256);

            // pays
            $table->set('pay_delivery', ['receiver', 'sender'])->default('receiver');
            $table->set('pay_imposed', ['receiver', 'sender'])->default('receiver');
            $table->boolean('is_payed')->default(0);
            $table->decimal('prepayment', 10, 2)->nullable();

            // prices
            $table->decimal('discount', 10, 2)->nullable();
            $table->decimal('delivery_price', 10, 2)->nullable();
            $table->decimal('full_sum', 10, 2);

            $table->text('comment');
            $table->integer('sending')->default(0);


            // relations
            $table->integer('author_id')->unsigned()->default(1);
            $table->integer('pay_id')->unsigned()->nullable();
            $table->integer('courier_id')->unsigned()->default(0);
            $table->integer('logistic_id')->unsigned()->nullable();
            $table->integer('hint_id')->unsigned()->nullable();
            $table->integer('liable_id')->unsigned()->nullable();
            $table->integer('client_id')->unsigned()->nullable();
            $table->integer('site_id')->unsigned()->nullable();
            $table->integer('order_professional_id')->unsigned()->nullable();

            // dates
            $table->time('time_with', false);
            $table->time('time_to', false);
            $table->date('date_delivery')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
