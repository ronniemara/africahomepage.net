<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TagsTableSeeder extends Seeder {

	public function run()
	{
		
                $tag_names = ['westafrica', 'ebola', 'football',
                    'politics', 'eastafrica', 'southernafrica',
                    'central africa', 'sports',
                    'football', 'afcon', 'economy',
                    'business', 'music', 'africanmovies'];
		foreach($tag_names as $tag)
		{
			Tag::create([
                            'name' => $tag,
                            'updated_at' => new DateTime,
                            'created_at'=> new DateTime
			]);
		}
	}

}