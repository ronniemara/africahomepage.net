<?php

class UsersController extends \BaseController {
    
    public function __construct(){
      $this->beforeFilter('captcha', ['only' => 'store']);  
}
    

	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}
        
        public function postActivate($activation_code) {
        if (is_null($activation_code)) {
            return Response::make(['flash' => 'Please register in order to activate account'], 401);
        }

        $user = User::whereActivationCode($activation_code)->first();

        if (is_null($user)) {
            return Response::make(['flash' => 'User not found. Please register.'], 401);
        }

        $user->activated = 1;
        $user->activation_code = null;
        $user->save();
    }

    /**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store()
                
	{
                
		$rules = ["email" => "required|email|unique:users",
                        "firstName" => "required|alpha",
                        "lastName" => "required|alpha",
                        "username" => "required|unique:users|between:7,10|alpha_num",
                        "password" => "required|min:7|confirmed:password_confirmation"];
                
        $input = Input::only(["email","firstName", "lastName",
                    "username", "password", "password_confirmation"]);
		
		//validation
		$validator = Validator::make($input, $rules);
                
                if($validator->fails()){
                    return Response::make(['flash'=> [$validator->messages()->all()]], 400);
                }
                $user = new User;
                $user->username = Input::get('username');
                    $user->email    = Input::get('email');
                    $user->password    = Hash::make(Input::get('password'));
                    $user->first_name    = Input::get('firstName');
                    $user->last_name   = Input::get('lastName');
                    $data['confirmation_code'] = str_random(30);
                    $user->activation_code = $data['confirmation_code'];
                //store user
                $user->save();
                //email user activation code
                try{
                Mail::queue('emails.auth.welcome', $data, function ($message){
                    $message->to(Input::get('email'), Input::get('username'))
                            ->subject('Verify your email address');
                });
                } catch(Exception $e){
                    return Response::make(['flash' => $e->getMessage()],500);
                }
		
                return Response::make(['flash' => 'Account verification email sent!']);
	}

	/**
	 * Display the specified resource.
	 * GET /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	

	/**
	 * Update the specified resource in storage.
	 * PUT /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
