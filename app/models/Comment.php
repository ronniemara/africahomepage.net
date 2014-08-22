<?php

class Comment extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		// 'user_id' => 'required',
		// 'post_id' => 'required',
		// 'message' => 'required'
	
	);
        
        public function user()
    {
        return $this->belongsTo('User');
    }
    
    public function votes()
    {
        return $this->morphMany('Vote', 'votable');
    }
    
}
