<?php
use Myapp\Repositories\PostRepositoryInterface as PostRepositoryInterface;
class PostsController extends \BaseController {

    /**
     * Post Repository
     *
     * @var Post
     */
    protected $post = null;
    protected $user = null;
    protected $tag = null;

    public function __construct(PostRepositoryInterface $post, User $user, Tag $tag )
    {
        $this->post = $post;    
	$this->user = $user;
	$this->tag = $tag;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
      
      public function index()
      {
        $posts = $this->post->with(['comments.author', 'author', 'tags'])->get();
        foreach ($posts as $post) {
            //Time elapsed since post created
            $age_in_hours = Carbon::now()->diffInHours($post->created_at);

            $votes = $post->votes; 
                
            //setting the rank of the post when displaying all posts
            $post->rank = $this->calculate_score($votes, $age_in_hours);
        }
       //$sortPosts = $posts->sortBy(function($post) {
       //             return $post->rank;
       //         })->reverse();

        //$postsValues = $sortPosts->values()->toArray();
        $postsValues = $posts->values()->toArray();
        
        return Response::make($postsValues, 200);
    }

        /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
	    $input = Input::except('tags');

	    $validation = Validator::make($input, Post::$rules);

	    if ($validation->fails()) {
		    return Response::make(["flash" => $validation->messages()], 412);
	    } 
	   		    //get user
		    $user = $this->getUser();
		    $input = new Post($input);
		    //insert post using user relationship
		    $post = $user->posts()->save($input);
		    //get tags input
		    $tags = Input::get('tags');
                    
                    $checked_tags = $this->check_tags($tags);
                    
                    $post->tags()->attach($checked_tags['tags']);
                    
                    $data = $this->post->find($post->id)->with('author', 'tags')->get();
                    
		   
		    return Response::make($data, 200);
	   
    }
    
    public function check_tags($tags)
            
    {
        $data = [];
         //remove tags that are already in db
        foreach ($tags as $tag) {
            $validation = Validator::make(['name' => $tag], Tag::$rules);
            if ($validation->fails()) {
                $failedRules = $validation->failed();
                
                if(isset($failedRules['name']['Unique'])) {
                        $retrieved = $this->tag->where('name', '=', $tag)->first();
                        $data['tags'][] = (int)$retrieved->id;
                    }else {
                        $data['errors'][] =[$tag => $messages];
                } 
           
            } else {
            $created = $this->tag->create(['name' => $tag]);
            $data['tags'][]  = (int)$created->id;
            }

        }
        
        return $data;
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
        
        $post = $this->post->find($id);
        $post->update($input);
        return Response::make($post);
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


