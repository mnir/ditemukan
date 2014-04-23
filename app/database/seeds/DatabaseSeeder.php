<?php

class DatabaseSeeder extends Seeder {

	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('CityTableSeeder');
		$this->call('EventTableSeeder');
		// $this->call('RoleTableSeeder');
	}
}

/* class RoleTableSeeder extends DatabaseSeeder {

	public function run()
	{
		DB::table('roles')->insert(
			array(
				array('name' => 'user'),
				array('name' => 'admin')
			)
		);
	}
} */

class CityTableSeeder extends DatabaseSeeder {

	public function run()
	{
		DB::table('cities')->insert(
			array(
				array('name' => 'Jakarta'),
				array('name' => 'Bandung'),
				array('name' => 'Semarang'),
				array('name' => 'Surabaya'),
				array('name' => 'Medan'),
			)
		);
	}
}

class EventTableSeeder extends DatabaseSeeder {

	public function run()
	{
		DB::table('events')->insert(
			array(
				array('name' => 'Hilang'),
				array('name' => 'Ditemukan')
			)
		);
	}
}