<?php
use Myapp\Repositories\TagRepositoryInterface as TagRepositoryInterface;

class BaseController extends Controller {

   protected $tag;

	public function __construct(TagRepositoryInterface $tag)
	{
		$this->beforeFilter('ngcsrf', array('on' => array('post', 'put', 'patch', 'delete')));
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

}
