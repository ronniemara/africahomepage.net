<?php
class CommentsController extends BaseController
{
	/**
     * Comment Repository
     *
     * @var $comment
     */
    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
        
    }
/**
     * Display a listing of the resource.
     *
     * @return Response
     */
      
      public function index()
      {
          
        $comments = $this->comment->all();
        foreach ($comments as $comment){
            $user = User::findOrFail($comment->user_id);
            $comment->username = $user->username;
        }
       return Response::json($comments);
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
	   
	    $input = Input::except('task');
	    $input['created_at'] = new DateTime;
	    
	    $comment = $this->comment->create($input);
       
	    //set comment->createdBy
        $user = Sentry::findUserById($comment->user_id);
        
        $comment->createdBy = $user->first_name . " " . $user->last_name;

	    return $comment;
	    			
        
    }

   
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->comment->find($id)->delete();

        
    }

}
