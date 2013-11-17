<?php
class CommentsController extends BaseController
{
	/**
     * Post Repository
     *
     * @var Post
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
	    $posts = $this->comment->all();



	    // return  View::make('posts.index', compact('posts'));
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
	    $comment->username = User::find($comment->user_id)->username;
	    
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
        $post = $this->post->findOrFail($id);
        return View::make('posts.show', compact('post'));
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
        $this->comment->find($id)->delete();

        //return Redirect::route('posts.index');
    }

}
