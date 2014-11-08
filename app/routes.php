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
Route::resource('posts', 'PostsController');
Route::resource('posts.comments', 'CommentsController');

Route::resource('opinions', 'OpinionsController');
Route::resource('opinions.comments', 'CommentsController');

Route::post('auth/login', 'AuthController@login');
Route::get('auth/logout', 'AuthController@logout');
Route::get('auth/check', 'AuthController@isLoggedIn');

Route::post('remind/email', 'RemindersController@postRemind');
Route::post('remind/password', 'RemindersController@postRemind');

Route::resource('users', 'UsersController');












