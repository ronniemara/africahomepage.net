<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CrawlerController
 *
 * @author ron
 */
class CrawlerController {
    //put your code here
    
    public function index() {
        $url = urldecode(Input::get('_escaped_fragment_'));
    }
}
