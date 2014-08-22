<?php


class Post extends Eloquent {
    protected $guarded = array();

    public static $rules = array(
		'url' => 'required'
		
	);    

    public function comments()
    {
        return $this->hasMany('Comment');
    } 
    
    public function votes()
    {
        return $this->morphMany('Vote', 'votable');
    }
    
    
}


