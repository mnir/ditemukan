<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profiles', function($table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->string('type',100);
			$table->biginteger('uid')->unsigned();
			$table->string('access_token');
			$table->string('access_token_secret');
			$table->string('photo');
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
		Schema::drop('profiles');
	}

}
