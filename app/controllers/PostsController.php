<?php

class PostsController extends BaseController {

    /**
     * Post Repository
     *
     * @var Post
     */
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
	    $posts = $this->post->all();

	    foreach($posts as $post)
	    {
		    $age_in_hours = Carbon::now()->diffInHours($post->created_at);

		    $karma = $post->karma;	 
		   $post->rank = $this->calculate_score($karma, $age_in_hours);
	    }
	    $posts = $posts->sortBy(function($post)
	    {
		$post->rank;	    
	    });

	    $posts =$posts->values();

	    return  View::make('posts.index', compact('posts'));
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
        $this->post->find($id)->delete();

        return Redirect::route('posts.index');
    }

    public function calculate_score($karma, $age_in_hours)
    {

	    return ($karma - 1) / pow(($age_in_hours + 2), 1.8);
    }
public function post_sorter($a, $b) 
	    {
		    if ($a['rank'] == $b['rank']) {
			            return 0;
				        }
		        return ($a['rank'] < $b['rank']) ? -1 : 1;
    }
}
