<?php

class LoginController extends BaseController {
	
	public function __construct() 
	{
		}

	public function getLogin()
	{
		return View::make('login.index');
		
	}



	public function postLogin()
	{
		
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

	public function getRegister()
	{
		return View::make('login.register');
	}

	public function postRegister()
	{
		try{
				$user = Sentry::createUser(
									array(
										'email' => Input::get('email'),
										'password' => Input::get('password'),
										'first_name' => Input::get('first_name'),
										'last_name' => Input::get('last_name'),
										)
									);
			} catch (Exception $e)
			{
				return $e->getMessage();
			}

			//add user to private group
			$user->addGroup(Sentry::findGroupByName('private'));

			//process data for using to send email to new user to confirm account

			 $email_data = array(
				'first_name' => $user->first_name,
				'email' => 'ronald.marangwanda@gmail.com'
				//$user->email
    );
			//get activation code
			 $activationCode = $user->getActivationCode();	
			
			 //pass activation code to view
			$view_data = array(
				'activationCode' => $activationCode
			);			
		//send email to new user with activation link
		 Mail::send('emails.auth.welcome', $view_data, function($message) use ($email_data)
		{
			$message->to($email_data['email'], $email_data['first_name'])->subject('Welcome');  
		});
			return Redirect::to('login')->with('message','Activation email sent');

	}


	public function logout()
	{
		Sentry::logout();
		Session::forget('currentUserName');
		return Redirect::to('/');
	}

	public function getActivate()
	{
		$activationCode = Input::get('x');

		//find user using activation code
		$user = Sentry::findUserByActivationCode($activationCode);

		//attempt to activate user
		try
		{
			if($user->attemptActivation($activationCode))
			{
				return Redirect::to('login')->with('message', 'Account activated!');
			}
			else
			{
				throw new Exception("Error Processing Request", 1);
				
			}
			
		} 
		catch (Exception $e)
		{
			return Redirect::to('login')->withErrors($e->getMessage());
		}
		
			
	}

			
	}















