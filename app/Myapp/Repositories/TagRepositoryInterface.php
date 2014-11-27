<?php
namespace Myapp\Repositories;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TagRepositoryInterface
 *
 * @author ron
 */
interface TagRepositoryInterface {
    //put your code here
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
      
      public function all();

        /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function find($id);
   
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function create($attributes);
    
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id);
    
    public function count(); 
    public function get();
    
}
