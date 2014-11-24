<?php


class Post extends Eloquent {
    protected $guarded = array();
    protected $hidden = ['user_id'];

    public static $rules = array(
//                'title' => 'required',
//		'url' => 'required'
		
	);    
    
    public function comments()
    {
        return $this->hasMany('Comment');
    } 
    
    public function author()
    {
        return $this->belongsTo('User', 'user_id');
    }
    
    public function getUsersIdAttribute($value)
    {
        return (int)$value;
    }
    
    public function getVotesAttribute($value)
    {
        return (int)$value;
    }
    
}


