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
Route::group(array('before' => 'Sentry'), function()
{
	Route::post('vote-up', 'VotesController@upvote');
	Route::post('vote-down', 'VotesController@downvote');
});
Route::get('getvotes', 'VotesController@getvotes');

Route::resource('opinion', 'OpinionController',  array('only' => array('index', 'show')));









