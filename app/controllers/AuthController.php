<?php


class AuthController extends BaseController {

    public function login() {
        $rules = ["email" => "required|email",
                        
                        "password" => "required"];
        $credentials = [
                  "email" => Input::json('email'),
                 "password" => Input::json('password'),
                    
                ];
        $validator = Validator::make($credentials, $rules);
        
        if($validator->fails()){
            return Response::make(['flash' => [$validator->messages()->all()]], 401);
        }
        $credentials['activated'] = 1;
        if (Auth::attempt($credentials, Input::get('remember'))) {
            return Response::json(Auth::user());
        } else {
            return Response::json(array('flash' => 'Invalid email or password!'), 401);
        }
    }

    public function logout() {
        Auth::logout();
        Response::json(array('flash' => 'Logged Out!'));
    }

    public function isLoggedIn() {

        $check = Auth::check();
        if (!$check) {
            return Response::make(["flash"=>"Please login!"], 401);
        }
       
        return Response::json(Auth::user());
    }
}
