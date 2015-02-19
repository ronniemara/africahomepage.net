<?php
use Myapp\Repositories\TagRepositoryInterface as TagRepositoryInterface;

class BaseController extends Controller {

   protected $tag;

	public function __construct(TagRepositoryInterface $tag)
	{
            $this->beforeFilter('ngcsrf', ['on' => ['post', 'put', 'patch', 'delete']]);
            $this->tag = $tag;
	}	

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
        
	protected function create_tag($new_tag)
	{
           $tags =  $this->tag->all();
            foreach ($tags as $tag){
                if($tag->name === $new_tag){
                    return;
                } else {
                    $this->tag->create($new_tag);
                }
            }
			
	}

	 protected function createToken($user)
        {
            $payload = array(
                'sub' => $user->id,
                'iat' => time(),
                'exp' => time() + (2 * 7 * 24 * 60 * 60) // 14 days
            );
            return JWT::encode($payload, Config::get('secrets.TOKEN_SECRET'));
        }


}
