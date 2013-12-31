<?php

class UsersController extends BaseController {

   

    public function __construct( )
    {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
	    $users = Sentry::findAllUsers();
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
	  $user = Sentry::findUserById($id);
      $posts = 
      $comments = 
      return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
       $user = Sentry::findUserById($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
       $user = Sentry::findUserById($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
     $user = Sentry::findUserById($id);   
    }

    public function calculate_score($karma, $age_in_hours)
    {

	    
    }
public function post_sorter($a, $b) 
	    {
		    
	    }
    public function saveComment()
    {

    }
}
