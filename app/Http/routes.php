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



	// =============================================
	// API ROUTES ==================================
	// =============================================
	Route::group(['prefix' => 'api'], function() {

		/* Since we will be using this just for CRUD, we won't need create and edit
		// Angular will handle both of those forms
		// this ensures that a user can't access api/create or api/edit when there's nothing there
         	*/
		Route::resource('posts', 'PostsController');

		//comments resource
		Route::resource('posts.comments', 'CommentsController');

		Route::resource('tags', 'TagsController');

		Route::post('remind/email', 'RemindersController@postRemind');
		Route::get('reset/{token}', 'RemindersController@getReset');
		Route::post('remind/password', 'RemindersController@postReset');

		Route::get('activate/{confirmationCode}', 'UsersController@postActivate');

		Route::resource('users', 'UsersController');
	});

	Route::post('auth/login', 'AuthController@login');
	Route::get('auth/signup', 'AuthController@signup');
	Route::post('auth/google', 'AuthController@google');
	Route::post('auth/live', 'AuthController@live');
	Route::post('auth/facebook', 'AuthController@facebook');
	Route::get('api/me', array('before' => 'auth', 'uses' => 'UsersController@getUser'));
	Route::put('api/me', array('before' => 'auth', 'uses' => 'UsersController@updateUser'));
















