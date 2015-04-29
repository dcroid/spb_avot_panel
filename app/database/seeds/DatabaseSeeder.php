<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('RolesTableSeeder');
		$this->call('Pattern_urlsTableSeeder');
		$this->call('Pattern_dataTableSeeder');
		$this->call('Content_urlsTableSeeder');
		$this->call('Content_dataTableSeeder');
		$this->call('Content_filesTableSeeder');
	}

}
