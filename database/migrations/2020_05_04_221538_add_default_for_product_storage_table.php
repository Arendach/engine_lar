<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddDefaultForProductStorageTable extends Migration
{
    public function up()
    {
        Schema::table('product_storage', function (Blueprint $table) {
            $table->integer('count')->default(0)->change();
        });
    }

    public function down()
    {
        Schema::table('product_storage', function (Blueprint $table) {
            $table->integer('count')->default(0)->change();
        });
    }
}
