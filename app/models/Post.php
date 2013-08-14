<?php

class Post extends Ardent {
    protected $guarded = array();

    public static $rules = array(
		'url' => 'required',
		'karma' => 'required'
	);
	
    public function user()
    {
	return $this->belongsTo('User');	
    }

    public function comments()
    {
    	return $this->hasMany('Comment'); 	 
    }

}
