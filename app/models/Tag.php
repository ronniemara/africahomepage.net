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
               'name' => 'required|unique:tags|alpha_dash|max:10|min:3',
	);  
  
    public function posts(){
        return $this->belongsToMany('Post');
    }
}
