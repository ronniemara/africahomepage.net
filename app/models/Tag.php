<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tag
 *
 * @author ron
 */
class Tag extends Eloquent {
    
    public $fillable = ['name'];
    
    public static $rules = array(
               'name' => 'required|alpha_dash|max:15|min:3|unique:tags',
	);  
  
    public function posts(){
        return $this->belongsToMany('Post');
    }
}
