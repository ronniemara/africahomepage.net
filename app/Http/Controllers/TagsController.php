<?php
namespace App\Http\Controllers;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Myapp\Repositories\TagRepositoryInterface as TagsRepositoryInterface;
/**
 * Description of TagsController
 *
 * @author ron
 */
class TagsController extends Controller{
    
    protected $tags;
    
    public function __construct(TagsRepositoryInterface $tags) {
        $this->tags = $tags;
    }
    
    public function index(){
        $data = [];
        $term = Input::get('term');
        $tags = $this->tags->all();
            foreach($tags as $tag){
                if(starts_with($tag->name, $term) === TRUE){
                    $data[] = $tag->name;
                }
            }
        return Response::json($data);
    }
}
