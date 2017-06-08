<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('categoryarea_id');
            $table->tinyInteger('priority');
            $table->string('description');
            $table->string('cover');
            $table->integer('modify_id');
            $table->enum('status', ['open', 'close', 'lock', 'delete']);
            $table->enum('status_record', ['open', 'close', 'lock', 'delete']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
