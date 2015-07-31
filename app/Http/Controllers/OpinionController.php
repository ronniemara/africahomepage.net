<?php
namespace App\Http\Controllers;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class OpinionController extends Controller
{
    protected $opinion = null;
    public function __construct(Opinion $opinion) {
        $this->opinion = $opinion;
    }
    
    public function index() {
        $opinions = $this->opinion->all();
        
        return Response::make($opinions, 200);
        
    }
}
