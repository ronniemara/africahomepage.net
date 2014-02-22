<?php

class UsersController extends BaseController {

   
   protected $post;
   protected $comment;
   
   

    public function __construct(Post $post, Comment $comment)
    {
      $this->post = $post;
      $this->comment = $comment;
    }
  
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
	$users = Sentry::findAllUsers();
        foreach ($users as $user)
        {
             //get group that user belongs to
             $groupArray = json_decode($user->getGroups(), true);
             foreach ($groupArray as $group)
             {
             $user->groupName = $group['name'];
             }
            
            
        }
        return View::make('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
      return View::make('users.register');  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
                $rules = array(
                                'password' => 'min:8|same:password2', 
                                'email' => 'same:email2',
                                'recaptcha_response_field' => 'required|recaptcha'      
                                );
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::to('/users/create')->withErrors($validator);
		}
		try{
			$user = Sentry::register(
                                array(
				'email' => Input::get('email'),
				'password' => Input::get('password'),
				'first_name' => Input::get('first_name'),
				'last_name' => Input::get('last_name')
			)
		);
			// Let's get the activation code
			$activationCode = $user->getActivationCode();

			//process data for using to send email to new user 
			$email_data = array('first_name' => $user->first_name,'email' => 'ronald.marangwanda@gmail.com');
			//pass activation code to view
			$view_data = array('activationCode' => $activationCode);

			//send email to new user with activation link
			try
			{
				Mail::send(	'emails.auth.welcome', $view_data, function($message) use ($email_data)
			{
				$message->to($email_data['email'], $email_data['first_name'])->subject('Welcome');  
			}
				);
				return Redirect::to('login')->with('message','Activation email sent');

			} catch (Exception $e)
			{
				return $e->getMessage();
			}
			//add user to private group
			$user->addGroup(Sentry::findGroupByName('private'));

		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
			return Redirect::to('/register')->withErrors('Login field is required.');
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
			return Redirect::to('/register')->withErrors('Password field is required.');
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
			return Redirect::to('/register')->withErrors('User with this login already exists.');
		}
    }
    
    /**
	 * [getActivate description]
	 * @return [type] [description]
	 */
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

	public function getResetPassword()
	{
		return View::make('users.reset_password');
	}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
	  $user           = Sentry::findUserById($id);
          $user->posts    = $this->post->where('user_id','=', $user->id)->get();
          $user->comments = $this->comment->where('user_id','=', $user->id)->get();
          return View::make('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = Sentry::findUserById($id);
        return View::make('users.edit', compact('user'));
    
    }

/**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
       try
        {
            // Find the user using the user id
            $user = Sentry::findUserById($id);

                // Update the user details
                $user->email = Input::get('email');
                $user->first_name = Input::get('first_name');

                // Update the user
                if ($user->save())
                {
                // User information was updated
                }
                else
                {
                // User information was not updated
                }
        } catch (Cartalyst\Sentry\Users\UserExistsException $e)
        {
            echo 'User with this login already exists.';
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            echo 'User was not found.';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
     try
        {
            // Find the user using the user id
            $user = Sentry::findUserById($id);

            // Delete the user
            $user->delete();
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            return Redirect('/users')->withError('User was not found.');
        }   
    }

}
