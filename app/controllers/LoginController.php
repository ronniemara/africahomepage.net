<?php

class LoginController extends BaseController {
	
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

		} else { 

			$credentials = array('email' => $input['email'], 'password' => $input['password']);

			if(Auth::attempt($credentials))
			{

				return Redirect::to('/');

			} else {

				return Redirect::to('login');
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

		$rules = array('username' => 'required|unique:users', 'email' => 'required|unique:users|email', 'password' => 'required');

		$v = Validator::make($input, $rules);

		if($v->passes())
		{
			$password = $input['password'];
			$password = Hash::make($password);

			$user = new User();
			$user->username = $input['username'];
			$user->email = $input['email'];
			$user->password = $password;
			$user->save();

			return Redirect::to('login');

		} else {

			return Redirect::to('register')->withInput()->withErrors($v);

		}
	}


	public function logout()
	{
		Auth::logout();
		return Redirect::to('/');
	}








}








