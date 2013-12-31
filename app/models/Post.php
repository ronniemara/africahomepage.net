<?php


class Post extends Eloquent {
    protected $guarded = array();

    public static $rules = array(
		'url' => 'required',
		'karma' => 'required'
	);
	
    

    public function comments()
    {
        return $this->hasMany('Comment');
    } 	 
}


