<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePurchasesTable extends Migration
{
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();

            $table->integer('manufacturer_id')->unsigned();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('type')->default(0);
            $table->decimal('sum', 10, 2)->default(0);
            $table->text('comment')->nullable();
            $table->integer('storage_id')->unsigned();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
