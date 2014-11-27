<?php
namespace Myapp\Repositories;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EloquentTagRepository
 *
 * @author ron
 */
class EloquentTagRepository implements TagRepositoryInterface {
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
      
      public function all(){
              return \Tag::all();
      }

        /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function find($id){
        return \Tag::findOrFail($id);
    }
   
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function create($attributes){
        return \Tag::create($attributes);
    }
    
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id){
        return \Tag::destroy($id);
    }
    
    public function count(){
        return \Tag::count();
    }
    public function get(){
        return \Tag::get();
    }
    
    public function with($relations){
    return \Tag::with($relations);
    }
    
}
