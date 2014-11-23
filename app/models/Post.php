<?php


class Post extends Eloquent {
    protected $guarded = array();

    public static $rules = array(
//                'title' => 'required',
//		'url' => 'required'
		
	);    

    public function comments()
    {
        return $this->hasMany('Comment');
    } 
    
    public function users()
    {
        return $this->belongsTo('User', 'users_id');
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


