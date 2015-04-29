<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Accaunt extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('avito_accaunt', function(Blueprint $table) {
			$table->increments('id');
			$table->string('email');
			$table->string('password', 60);
			$table->string('name', 100);
			$table->string('tel')->unique();
			$table->string('code', 10);
			$table->integer('user_id');
			$table->integer('step_reg');
			$table->integer('tmp_typeobj');
			// $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
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
		//
		Schema::drop('avito_accaunt');
	}

}
