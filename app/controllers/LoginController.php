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
		$input = Input::all();

		$rules = array('email' => 'required', 'password' => 'required');

		$v = Validator::make($input, $rules);

		if($v->fails())
		{

			return Redirect::to('login')->withErrors($v);

		} else 
		{ 

	 		$credentials = array( 'email' => $input['email'], 'password' => $input['password']);

    			$user = Sentry::findByCredentials($credentials);

			    // Log the user in
			    Sentry::login($user, false);
		}	 
				if ($user)
				{
					return Redirect::route('/');
				}
			}
			catch(\Exception $e)
			{
				return Redirect::route('login')->withErrors(array('message' => $e->getMessage()));
			}	
		}
	}

	public function getRegister()
	{
		return View::make('login.register');
	}

	public function postRegister()
	{
		$input = Input::all();

		$rules = array('username' => 'required|unique:users', 'email' => 'required|unique:users|email', 'password' => 'required', 'password' => 'same:password2');

		$v = Validator::make($input, $rules);

		if($v->passes())
		{       
			//getting the input from the user
			$password = $input['password'];
			$password = Hash::make($password);
			//create token for confirming account
			$token = bin2hex(openssl_random_pseudo_bytes(16));

			//instatiate user, assign input values to user object and save user in database	
			$user = new User();
			$user->username = $input['username'];
			$user->email = $input['email'];
			$user->password = $password;
			$user->token = $token;
			$user->save();

			//process data for using to send email to new user to confirm account

			 $email_data = array(
				'username' => $user->username,
				'email' => 'ronald.marangwanda@gmail.com'
				//$user->email
    );
	
			$view_data = array(
				'token' => $token
			);			
		//send email to new user with activation link
		 Mail::send('emails.auth.welcome', $view_data, function($message) use ($email_data)
		{
			$message->to($email_data['email'], $email_data['username'])->subject('Welcome');  
		});
			return Redirect::to('login')->with('message','Activation email sent');

		} else {

			return Redirect::to('register')->withInput()->withErrors($v);

		}
	}


	public function logout()
	{
		Sentry::logout();
		return Redirect::to('/');
	}

	public function getActivate()
	{
		$token = Input::get('x');
		
		$count = User::where('token','=', $token)->count(); 
		if($count <= 1)
		{
				if($count = 0)
				{
					return Redirect::to('login')->with('message', 'Account not activated, plase register and activate your account');
				}
				else
				{
					//convert active from false to true
				$user_id = User::where('token', '=', $token)->pluck('id');
				$user = User::find($user_id);
				$user->active = true;
				$user->save();

				// redirect to login page with flash
				return Redirect::to('login')->with('message', 'Account is now active');
				}
		}
		else
		{
				throw new Exception;
				return Redirect::to('login')->with('message', 'Account not activated, plase register and activate your account');
		}

			
	}

			
	}















