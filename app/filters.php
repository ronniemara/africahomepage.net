<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
	if( ! Request::secure())
    {
        return Redirect::secure(Request::path());
    }
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('login');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});


/**
* *  Sentry filter
* *
* * Checks if the user is logged in
* */
Route::filter('Sentry', function()
	{
		if ( ! Sentry::check()) {			
			if (Request::ajax())
			{
			return json_encode(false);
			}
			else		
			{
			return Redirect::to('login')->with('message', 'Please login!');	
			}
		}
});
 
/**
	* * hasAcces filter (permissions)
	* *
	* * Check if the user has permission (group/user)
	* */
Route::filter('hasAccess', function($route, $request, $value)
{
	try
	{
		$user = Sentry::getUser();
		 
		if( ! $user->hasAccess($value))
		{
			return Redirect::route('cms.login')->withErrors(array(Lang::get('user.noaccess')));
		}
	}
	catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
	{
		return Redirect::route('cms.login')->withErrors(array(Lang::get('user.notfound')));
	}
	 
});
 
/**
 * * InGroup filter
 * *
 * * Check if the user belongs to a group
 * */
Route::filter('inGroup', function($route, $request, $value)
{
	try
	{
		$user = Sentry::getUser();
		 
		$group = Sentry::findGroupByName($value);
		 
		if( ! $user->inGroup($group))
		{
			return Redirect::route('login')->withErrors(array(Lang::get('user.noaccess')));
		}
	}
	catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
	{
		return Redirect::route('login')->withErrors(array(Lang::get('user.notfound')));
	}
	 
	catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
	{
		return Redirect::route('login')->withErrors(array(Lang::get('group.notfound')));
	}
});

Route::filter('ngcsrf',function($route,$request) {
     
    $token = md5(Session::token());
    $supplied = $request->header('X-XSRF-TOKEN');
     
    if(empty($supplied) || $token != $supplied) {
        throw new Illuminate\Session\TokenMismatchException;
    }
});

Route::filter('timeout',function() {
    $expired = true;
    if ((time() - Session::activity()) > (Config::get('session.lifetime') * 60))
    {
        // Session expired
        $expired = true;
    }
 else {
        
 $expired = true;
     
 }
     
  if($expired)
  {
      return Response::make('flash => Your session has expired. Please try again!', 404);
  }
});

Route::filter('captcha', function(){
    $privatekey = "6LdeD_wSAAAAAEVqwI8sFQC42bZRRCFN-96imxkU";
    $resp = \Myapp\Recaptcha\Recaptcha->recaptcha_check_answer ($privatekey,
        Request::getClientIp(),
        Input::get("challenge"),
        Input::get("response"));
    if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    return Response::make(['flash' => "The reCAPTCHA wasn't entered correctly. Please try it again."], 401); 
         
} 

});