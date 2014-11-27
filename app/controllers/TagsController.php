<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TagsController
 *
 * @author ron
 */
class TagsController extends BaseController{
    
    protected $tags;
    
    public function __construct(TagsRepositoryInterface $tags) {
        $this->tags = $tags;
    }
    
    public function index(){
        $data = [];
        $term = Input::get('term');
        $tags = ['ebola', 'westafrica', 'politics', 'economy', 'football'];
            foreach($tags as $tag){
                if(starts_with($tag, $term) === TRUE){
                    $data[] = $tag;
                }
            }
        return Response::json($data);
    }
    
    public function startsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }
}
