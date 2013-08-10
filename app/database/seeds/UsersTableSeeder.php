<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('users')->truncate();

		$users = array(
			'username' => 'def_con_6','email'=>'ronaldmarangwanda@yahoo.com', 'password' => Hash::make('1needaj0b'), 'created_at' => new DateTime, 
			'updated_at' => new DateTime
		);

		// Uncomment the below to run the seeder
		DB::table('users')->insert($users);
	}

}
