<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id')->unsigned();
            $table->integer('author_id')->unsigned();
            $table->longText('content');
            $table->enum('type', ['success', 'info', 'danger', 'warning'])->default('info');
            $table->boolean('is_success')->default(false);
            $table->text('comment')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->boolean('is_approve')->default(false);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
