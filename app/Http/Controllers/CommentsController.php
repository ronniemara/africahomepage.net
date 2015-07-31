<?php
namespace App\Http\Controllers;
class CommentsController extends Controller
{
	/**
     * Comment Repository
     *
     * @var $comment
     */
    protected $comment;
     protected $post;

    public function __construct(Comment $comment, Post $post )
    {
        $this->comment = $comment;
        $this->post = $post;
        
    }
/**
     * Display a listing of the resource.
     *
     * @return Response
     */
      
      public function index($post_id)
      {
          
        $comments = $this->comment->with('author')->where('post_id', '=', $post_id)->get();
        if($comments != null){
        foreach ($comments as $comment){
            $user = User::findOrFail($comment->user_id);
            $comment->username = $user->username;
        }
        return Response::json($comments);
        }
        else{
            return Response::json(['comments'=> 0]);
        }
       
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
    public function store($post_id)
    {
	   
	    $input = Input::message();
            
            // The user is logged in...
                if(Auth::check()){
                    $new_comment = $this->comment($input);
                $post = $this->post->findOrFail($post_id);
                $comment = $post->comments()->save($new_comment);
	    
                }
               else {
                   return Response::make(['flash' => 'Please login to comment'], 401);
                }
       
	    
        
       

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
