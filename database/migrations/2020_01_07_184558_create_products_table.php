<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');

            // main info
            $table->string('name_uk', 256);
            $table->string('name_ru', 256)->nullable();
            $table->string('article', 256);
            $table->string('model_uk', 256);
            $table->string('model_ru', 256)->nullable();
            $table->string('service_code', 256)->nullable();
            $table->text('description_uk')->nullable();
            $table->text('description_ru')->nullable();

            // prices
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('procurement_price', 10, 2)->nullable();

            // types
            $table->boolean('is_accounted')->default(true);
            $table->boolean('is_combine')->default(false);

            // attributes
            $table->text('attributes')->nullable();
            $table->decimal('weight', 10, 3)->default(0);
            $table->json('volume')->nullable();

            // new fields
            $table->json('packing')->nullable();
            $table->string('video', 256)->nullable();
            $table->string('id_storage', 256)->nullable();

            // seo
            $table->string('meta_title_uk', 256)->nullable();
            $table->string('meta_title_ru', 256)->nullable();
            $table->string('meta_keywords_uk', 256)->nullable();
            $table->string('meta_keywords_ru', 256)->nullable();
            $table->string('meta_description_uk', 256)->nullable();
            $table->string('meta_description_ru', 256)->nullable();
            $table->string('product_key', 32)->unique();

            // dates
            $table->timestamps();
            $table->softDeletes();

            // relations
            $table->integer('category_id')->unsigned();
            $table->integer('manufacturer_id')->unsigned();
            $table->integer('author_id')->unsigned();

            // $table->foreign('category_id')->references('id')->on('categories');
            // $table->foreign('manufacturer_id')->references('id')->on('manufacturers');
            // $table->foreign('author_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
