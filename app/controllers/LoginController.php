<?php

class LoginController extends BaseController {
	
	
/**
     * Instantiate a new LoginController instance.
     */
    public function __construct()
    {

        $this->beforeFilter('csrf', array('on' => array('postLogin','postRegister')));

    }



	/*
	*Get the login page
	*/
	public function getLogin()
	{
		return View::make('login.index');
		
	}


	/**
	 * [postLogin description]
	 * @return [type] [description]
	 */
	public function postLogin()
	{
		//$rules = array('recaptcha_response_field' => 'required|recaptcha');		
		//$validator = Validator::make(Input::all(), $rules);

		//if ($validator->fails())
		//{
		//	return Redirect::to('/login')->withErrors($validator);
		//}
		try
		{
		    // set login credentials
			$credentials = array(
		    	'email'    => Input::get('email'),
		    	'password' => Input::get('password'),
		    	);

			// authenticate
		    $currentUser = Sentry::authenticate($credentials, false);
		    //put first and last name in session
		    Session::put('currentUserName', $currentUser->first_name . " ". $currentUser->last_name);
		    //redirect to homepage
		    return Redirect::to('/'); 

		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
		    return Redirect::to('login')->withError('Login field is required');
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
		    return Redirect::to('login')->withErrors('Password field is required.');
		}
		catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
		{
		    return Redirect::to('login')->withErrors('Incorrect login/password');
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    return Redirect::to('login')->withErrors('User was not found.');
		}
		catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
		{
		    return Redirect::to('login')->withErrors('User is not activated.');
		}

		// The following is only required if throttle is enabled
		catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
		{
		    return Redirect::to('login')->withErrors('User is suspended.');
		}
		catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
		{
		    return Redirect::to('login')->withErrors('User is banned.');
		}

	}
	

	/**
	 * [logout description]
	 * @return [type] [description]
	 */
	public function logout()
	{
		Sentry::logout();
		Session::forget('currentUserName');
		return Redirect::to('/');
	}
	
			
	}















