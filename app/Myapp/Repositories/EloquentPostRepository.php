<?php
namespace Myapp\Repositories;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EloquentPostRepository
 *
 * @author ron
 */
class EloquentPostRepository implements PostRepositoryInterface  {
    
    protected $post;

    public function __construct(\Post $post) {
        $this->post = $post;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
      
      public function all()
      {
          return $this->post->all();
      }

        /**
     * find one post.
     *
     * @return Response
     */
    public function find($id){
        return $this->post->findOrFail($id);
    }
    
    /**
     * find one post.
     *
     * @return Response
     */
    public function findOrFail($id){
        return $this->post->findOrFail($id);
    }
   
    /**
     * create the specified resource in storage.
     *
     * @param  array  $attributes
     * @return Response
     */
    public function create($attributes)
    {
        return $this->post->create($attributes);
    }
    
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id){
      return  $this->post->delete($id);
    }
    
    public function count(){
       return $this->post->count();
    } 
    public function get(){
      return  $this->post->get();
    }
    
    public function with($relations){
    return $this->post->with($relations);
    }
    
    public function tags(){
    
        return $this->post->tags();
    }
    
}
