<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class OpinionTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
                        
		{       $sentence =$faker->sentence();
                    $string = substr($sentence, 0, strlen($sentence) - 1);
			Opinion::create([
                             'title' => $string,
                                'body' => $faker->paragraphs(4),
                            'user_id'=> 1,
            'created_at' => $faker->dateTime,
            'updated_at'=> $faker->dateTime
                            
			]);
		}
	}

}