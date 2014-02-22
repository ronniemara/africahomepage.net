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
