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
				array('name' => 'Banda Aceh'),
				array('name' => 'Medan'),
				array('name' => 'Padang'),
				array('name' => 'Pekan Baru'),
				array('name' => 'Tanjung Pinang'),
				array('name' => 'Pangkal Pinang'),
				array('name' => 'Jambi'),
				array('name' => 'Palembang'),
				array('name' => 'Bengkulu'),
				array('name' => 'Bandar Lampung'),
				array('name' => 'Jakarta'),
				array('name' => 'Bandung'),
				array('name' => 'Serang'),
				array('name' => 'Semarang'),
				array('name' => 'Yogyakarta'),
				array('name' => 'Surabaya'),
				array('name' => 'Pontianak'),
				array('name' => 'Palangkaraya'),
				array('name' => 'Tanjung Selor'),
				array('name' => 'Samarinda'),
				array('name' => 'Banjarmasin'),
				array('name' => 'Denpasar'),
				array('name' => 'Mataram'),
				array('name' => 'Kupang'),
				array('name' => 'Manado'),
				array('name' => 'Gorontalo'),
				array('name' => 'Palu'),
				array('name' => 'Mamuju'),
				array('name' => 'Makassar'),
				array('name' => 'Kendari'),
				array('name' => 'Sofifi'),
				array('name' => 'Ambon'),
				array('name' => 'Manokwari'),
				array('name' => 'Jayapura'),
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
