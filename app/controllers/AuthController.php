<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AuthController extends BaseController {

    public function login() {
        if (Auth::attempt(
                [
                  "email" => Input::json('email'),
                 "password" => Input::json('password'),
                ],                 
                Input::get('remember')
                )
            ) {
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