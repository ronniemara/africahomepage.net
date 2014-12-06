<?php
use Myapp\Repositories\PostRepositoryInterface as PostRepositoryInterface;
class PostsController extends BaseController {

    /**
     * Post Repository
     *
     * @var Post
     */
    protected $post = null;

    public function __construct(PostRepositoryInterface $post, User $user )
    {
        $this->post = $post;    
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
      
      public function index()
      {
        $posts = $this->post->with(['comments.author', 'author'])->get();
        foreach ($posts as $post) {
            //Time elapsed since post created
            $age_in_hours = Carbon::now()->diffInHours($post->created_at);

            $votes = $post->votes; 
                
            //setting the rank of the post when displaying all posts
            $post->rank = $this->calculate_score($votes, $age_in_hours);
        }
       $sortPosts = $posts->sortBy(function($post) {
                    return $post->rank;
                })->reverse();

        $postsValues = $sortPosts->values()->toArray();
        
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
        // The user is logged in...
                if(Auth::check()){
                    //get user
                $user = Auth::getUser();
                $input = new Post($input);
                //insert post using user relationship
                $post = $user->posts()->save($input);
                //get tags input
                $tags = Input::get('tags');
                foreach ($tags as $tag) {
                    $validation = Validator::make(['name' => $tag], Tag::$rules);
                    if ($validation->fails()) {
                      return Response::make(["flash" => $validation->messages()], 412);  
                    } 
                    $model = new Tag(['name' => $tag]);
                    $post->tags()->save($model);
                }
                
                unset($input['tags']);
                
                

            return Response::make($post, 200);
            } else {
                return Response::make(["flash" => "Please log in"], 400);    
            }
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

            return Response::make($post);
        }

        return Response::make('$post', 401);
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


