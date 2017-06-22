<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system', function (Blueprint $table) {
			$table->increments('id');
			$table->string('contact_email');
			$table->string('inquiry_email');
			$table->string('web_title');
			$table->string('web_description');
			$table->string('office_info_phone');
			$table->string('office_info_email');
			$table->enum('social_look', ['single', 'horizontal']);
			$table->enum('social_skin', ['flat', 'classic', 'birman']);
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
        Schema::dropIfExists('system');
    }
}
