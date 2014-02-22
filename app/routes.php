<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//main-page
Route::get('/', 'PostsController@index');


//posts resource
Route::resource('posts', 'PostsController');

//comments resource
Route::resource('comments', 'CommentsController');

//users resource
Route::resource('users', 'UsersController');
//user activation routes
Route::get('users/activate', 'UsersController@getActivate');


//login routes
Route::get('login', 'LoginController@getLogin');
Route::post('login', 'LoginController@postLogin');
//logout route
Route::get('logout', 'LoginController@logout');










