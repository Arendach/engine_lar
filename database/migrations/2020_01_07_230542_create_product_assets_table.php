<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductAssetsTable extends Migration
{
    public function up()
    {
        Schema::create('product_assets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 32);
            $table->integer('storage_id')->unsigned();
            $table->decimal('price', 10, 2);
            $table->decimal('course', 10, 2)->default(1);
            $table->string('code', 32)->nullable();
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_assets');
    }
}
