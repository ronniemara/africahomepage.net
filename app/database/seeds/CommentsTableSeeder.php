<?php

class CommentsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('comments')->truncate();

		$comments = array(
		'user_id' => 1, 'post_id' => 0, 'message' => 'greate post', 'created_at' => new DateTime, 'updated_at' => new DateTime
		);

		// Uncomment the below to run the seeder
		DB::table('comments')->insert($comments);
	}

}
