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
Blade::setContentTags('<%', '%>');   // for variables and all things Blade
Blade::setEscapedContentTags('<%%', '%%>');  // for escaped data
//main-page
Route::get('/', function() {
    return View::make('layouts.bootstrap');
});


// =============================================
// API ROUTES ==================================
// =============================================
Route::group(array('prefix' => 'api'), function() {

	// since we will be using this just for CRUD, we won't need create and edit
	// Angular will handle both of those forms
	// this ensures that a user can't access api/create or api/edit when there's nothing there
Route::resource('posts', 'PostsController');
//comments resource
Route::resource('posts.comments', 'CommentsController');

Route::resource('tags', 'TagsController');


Route::post('auth/login', 'AuthController@login');
Route::get('auth/logout', 'AuthController@logout');
Route::get('auth/check', 'AuthController@isLoggedIn');

Route::post('remind/email', 'RemindersController@postRemind');
Route::get('reset/{token}', 'RemindersController@getReset');
Route::post('remind/password', 'RemindersController@postReset');

Route::resource('users', 'UsersController');
});

// =============================================
// CATCH ALL ROUTE =============================
// =============================================
// all routes that are not home or api will be redirected to the frontend
// this allows angular to route them
App::missing(function($exception)
{
	return View::make('layouts.bootstrap');
});


Route::get('_escaped_fragment_', 'CrawlerController@index');




Route::get('activate/{confirmationCode}', 'UsersController@postActivate');













