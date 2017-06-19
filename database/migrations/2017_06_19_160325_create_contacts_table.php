<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact', function (Blueprint $table) {
			$table->increments('id');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('company');
			$table->integer('tel');
			$table->integer('fax');
			$table->string('address');
			$table->string('email');
			$table->text('memo');
			$table->enum('status', ['open', 'close', 'lock', 'archive','delete']);
			$table->enum('read', ['unread', 'read']);
			$table->integer('reader');
			$table->dateTime('read_time');
			$table->ipAddress('ip');
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
        Schema::dropIfExists('contact');
    }
}
