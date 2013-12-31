<?php
class CommentsController extends BaseController
{
	/**
     * Comment Repository
     *
     * @var $comment
     */
    protected $comment;

    /*
    *User repository
    */
    protected $user;

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
	    //$comments = $this->comment->all();


        return View::make('comments.index');
        //$comments;
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
	    // $validation = Validator::make($input, Comment::$rules); 

        // if ($validation->passes())
        // {
	    $comment = $this->comment->create($input);
       
	    //set comment->createdBy
        $user = Sentry::findUserById($comment->user_id);
        
        $comment->createdBy = $user->first_name . " " . $user->last_name;

	    return $comment;
	    			
        // }
        //   echo 'errors';
        // return Redirect::route('posts.create')
        //     ->withInput()
        //     ->withErrors($validation)
	    // ->with('message', 'There were validation errors.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $comment = $this->comment->findOrFail($id);
        return View::make('comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $comment = $this->comment->find($id);

        if (is_null($post))
        {
            return Redirect::route('comments.index');
        }

        return View::make('comments.edit', compact('comment'));
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
        $validation = Validator::make($input, $comment::$rules);

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
        $this->comment->find($id)->delete();

        //return Redirect::route('posts.index');
    }

}
