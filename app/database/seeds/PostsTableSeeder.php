<?php

class PostsTableSeeder extends Seeder {

    public function run()
    {
    	// Uncomment the below to wipe the table clean before populating
    	// DB::table('posts')->delete();

        $posts = array(
            'title' => "Zim going down the drain",
            'url'=>"http://newzimbabwe.com",
            'users_id'=> 1,
            'created_at' => new DateTime(),
            'updated_at'=> new DateTime()

        );

        // Uncomment the below to run the seeder
         DB::table('posts')->insert($posts);
    }

}