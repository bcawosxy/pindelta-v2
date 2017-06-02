<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryareaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoryarea', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('priority');
            $table->string('description');
            $table->string('cover');
            $table->integer('modify_id');
            $table->enum('status', ['open', 'close', 'delete']);
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
        Schema::dropIfExists('categoryarea');
    }
}
