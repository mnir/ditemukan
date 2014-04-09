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
		$this->call('CityTableSeeder');
	}

}

class CityTableSeeder extends Seeder {

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