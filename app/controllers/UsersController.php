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
        if (!$activation_code) {
            return Response::make(['flash' => 'User not found'], 401);
        }

        $user = User::whereConfirmationCode($activation_code)->first();

        if (!$user) {
            return Response::make(['flash' => 'User not found'], 401);
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
                
		$rules = ["email" => "required|email|unique",
                        "firstName" => "required|alpha",
                        "lastName" => "required|alpha",
                        "username" => "requred|unique|between:7,10|alpha_num",
                        "password" => "required|min:7|confirmed:password2"];
        //
		$credentials = ['username' => Input::get('username'),
                                'email'    => Input::get('email'),
                                'password'    => Input::get('password'),
                                'first_name'    => Input::get('firstName'),
                                'last_name'   => Input::get('lastName')];
		//validation
		$validator = Validator::make($credentials, $rules);
                
                if($validator->fails()){
                    return Response::make(['flash'=> [$validator->messages()->all()]], 400);
                }
                
                $confirmation_code = str_random(30);
                $credentials['activation_code'] = $confirmation_code;
                //store user
                User::create($credentials);
                //email user activation code
                try{
                Mail::queue('emails.auth.welcome', $confirmation_code, function ($message){
                    $message->to(Input::get('email'), Input::get('username'))
                            ->subject('Verify your email address');
                });
                } catch(Exception $e){
                    return Response::make(['flash' => $e->getMessage()],500);
                }
		
                return Response::make(['flash' => 'Account varification email sent!']);
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
