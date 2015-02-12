<?php

use GuzzleHttp\Subscriber\Oauth\Oauth1;

class AuthController extends \BaseController {



    public function login()
    {
        $email = Input::get('email');
        $password = Input::get('password');

        $user = User::where('email', '=', $email)->first();

        if (!$user)
        {
            return Response::json(array('message' => 'Wrong email and/or password'), 401);
        }

        if (Hash::check($password, $user->password))
        {
            unset($user->password);
            return Response::json(array('token' => $this->createToken($user)));
        }
        else
        {
            return Response::json(array('message' => 'Wrong email and/or password'), 401);
        }
    }

    public function signup()
    {
        $input['displayName'] = Input::get('displayName');
        $input['email'] = Input::get('email');
        $input['password'] = Input::get('password');

        $rules = array('displayName' => 'required',
                       'email' => 'required|email|unique:users,email',
                       'password' => 'required');

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return Response::json(array('message' => $validator->messages()), 400);
        }
        else
        {
            $user = new User;
            $user->displayName = Input::get('displayName');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->save();
            return Response::json(array('token' => $this->createToken($user)));

        }
    }



}