<?php

class BaseController extends Controller {

    public $user = null;
    public $check_user = null;

	public function __construct()
	{
		$this->beforeFilter('ngcsrf', array('on' => array('post', 'put', 'patch', 'delete')));
        $this->user = \App::make('authenticator');
        $this->check_user = \App::make('authentication_helper');
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
        
        

}
