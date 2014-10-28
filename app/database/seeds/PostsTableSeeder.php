<?php

class PostsTableSeeder extends Seeder {

    public function run()
    {
    	// Uncomment the below to wipe the table clean before populating
    	 //::table('posts')->delete();

        $faker = Faker\Factory::create();
        foreach (range(1, 30) as $index){
            
            Post::create(
            [
                'title' => $faker->sentence(),
            'url'=> $faker->url,
            'users_id'=> 1,
            'created_at' => $faker->dateTime,
            'updated_at'=> $faker->dateTime
                ]);
        }  

        // Uncomment the below to run the seeder
         //::table('posts')->insert($posts);
    }

}