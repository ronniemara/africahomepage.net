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
Blade::setContentTags('<%', '%>'); 		// for variables and all things Blade
	Blade::setEscapedContentTags('<%%', '%%>'); 	// for escaped data
//main-page
Route::get('/', 
        function(){
    return View::make('layouts.bootstrap');
        });

Route::resource('posts', 'PostsController');


//comments resource
Route::resource('comments', 'CommentsController');
Route::group(array('before' => 'Sentry'), function()
{
	Route::post('vote-up', 'VotesController@upvote');
	Route::post('vote-down', 'VotesController@downvote');
});
Route::get('getvotes', 'VotesController@getvotes');


Route::post('reset-password',"Jacopo\Authentication\Controllers\AuthController@postReminder");
Route::post('signup', 'Jacopo\Authentication\Controllers\UserController@postSignup');








