<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class OpinionController extends BaseController
{
    protected $opinion = null;
    public function __construct(Opinion $opinion) {
        $this->opinion = $opinion;
    }
    
    public function index() {
        $opinions = $this->opinion->all();
        $opinionValues = $opinions->values();
        return View::make('opinion.index', compact('opinionValues'));
        
    }
}
