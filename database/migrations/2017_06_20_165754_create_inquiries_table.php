<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('inquiry', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('email');
			$table->string('quantity');
			$table->string('country');
			$table->string('company');
			$table->string('weblink');
			$table->string('demand');
			$table->text('memo');
			$table->enum('status', ['open', 'close', 'lock', 'archive', 'delete']);
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
        Schema::dropIfExists('inquiry');
    }
}
