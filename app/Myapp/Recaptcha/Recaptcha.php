<?php
namaspace \Myapp\Recaptcha;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Support\Facades\Facade as IlluminateFacade;
class Recaptcha extends IlluminateFacade {
    //put your code here
    protected static function getFacadeAccessor() { return 'recaptcha'; }
    
}
