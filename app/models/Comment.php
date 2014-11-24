<?php

class Comment extends Eloquent {
	protected $guarded = array();
        protected $visible = ['message', 'created_at', 'updated_at', 'author'];

        public static $rules = array(
		// 'user_id' => 'required',
		// 'post_id' => 'required',
		// 'message' => 'required'
	
	);
        
        public function author()
        {
        return $this->belongsTo('User', 'user_id');
        }
    
}
