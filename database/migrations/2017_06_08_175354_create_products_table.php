<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('category_id');
            $table->tinyInteger('priority');
            $table->string('description');
            $table->string('cover');
            $table->text('content');
            $table->string('model');
            $table->string('standard');
            $table->string('material');
            $table->string('produce_time');
            $table->string('lowest');
            $table->text('memo');
            $table->text('tags');
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
        Schema::dropIfExists('product');
    }
}
