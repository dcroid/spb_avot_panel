<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Advert extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('advert', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('tel_id');
			$table->integer('type_object'); // 1- Однокомнатная кв; 2-комнтаная кв; 3-треха кв; 0 комната
			$table->integer('advert_id');
			$table->integer('show_all');
			$table->integer('show_today');
			$table->integer('status'); // 0- не проверено; 1- живое; 2 - умерло
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
	}

}
