<?php

class PostsController extends BaseController {

    /**
     * Post Repository
     *
     * @var Post
     */
    protected $post = null;
    protected $votes = null;


    
    public function __construct(Post $post, Vote $votes )
    {
        $this->post = $post;    
        $this->votes = $votes;
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
//    public function homepage()
//    {
//        
//        
//        return View::make('posts.index');
     //$posts = $this->post->all()->toJson();
//return $this->post->all()->toJson();

         //foreach($posts as $post)
         //{
    		    //Time elapsed since post created
           // $age_in_hours = Carbon::now()->diffInHours($post->created_at);
           // $post->time_ago = Carbon::createfromTimeStamp(strtotime($post->created_at))->diffForHumans(); 
            
            //number of votes for post
            //$VoteObject = $this->post->find($post->id)->votes->first();            
            
             //$numberOfVotes = (int) $VoteObject->count;     
             
            

    	        //setting the rank of the post when displaying all posts
            //$post->rank = $this->calculate_score($numberOfVotes, $age_in_hours);
           

                //setting post->first_name  and post->last name properties

             //$userObject = $user->getUserById($post->user_id);
            /* $userObject = $user->getUserById(3);
            $post->username = $user->code;*/
            

        // }
         
         /*$sortPosts = $posts->sortBy(function($post)
                        { 
                            return $post->rank;        
                        })->reverse();
       
        $postsValues = $sortPosts->values();*/
//$postsValues = $post->values();
        //$check_user = $this->check_user;


            //return  View::make('posts.reddit2', compact('postsValues', 'check_user'));
           //return  $posts;

      //}
      
      public function index()
      {
          $data =  $this->post->all();
           //return
           return Response::make($data,200);
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, Post::$rules);

        if ($validation->passes())
        {	
		$user = Sentry::getUser();			
		$input['user_id'] = $user->id;	
            $this->post->create($input);

            return Redirect::route('posts.index');
        }

        return Redirect::route('posts.create')
        ->withInput()
        ->withErrors($validation)
        ->with('message', 'There were validation errors.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
       $post = $this->post->findOrFail($id);
       return Response::make($post, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $post = $this->post->find($id);

        if (is_null($post))
        {
            return Redirect::route('posts.index');
        }

        return View::make('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, Post::$rules);

        if ($validation->passes())
        {
            $post = $this->post->find($id);
            $post->update($input);

            return Redirect::route('posts.show', $id);
        }

        return Redirect::route('posts.edit', $id)
        ->withInput()
        ->withErrors($validation)
        ->with('message', 'There were validation errors.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->post->find($id)->delete();

        return Redirect::route('posts.index');
    }

    //calculate rank
    public function calculate_score($karma, $age_in_hours)
    {
     return (float)($karma - 1) / pow(($age_in_hours + 2), 1.8);
    }

}  


