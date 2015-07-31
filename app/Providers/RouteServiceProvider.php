<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
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

	Route::filter('ngcsrf',function($route,$request) {
	     
	    $token = md5(Session::token());
	    $supplied = $request->header('X-XSRF-TOKEN');
	     
	    if(empty($supplied) || $token != $supplied) {
		throw new Illuminate\Session\TokenMismatchException;
	    }
	});

	Route::filter('captcha', function(){
	    $privatekey = $_ENV['RECAPTCHA_KEY'];
	    
	    $resp = Recaptcha::recaptcha_check_answer ($privatekey,
		Request::getClientIp(),
		Input::get("challenge"),
		Input::get("response"));
	    if (!$resp->is_valid) {
	    // What happens when the CAPTCHA was entered incorrectly
	    return Response::make(['flash' => "The reCAPTCHA wasn't entered correctly. Please try it again."], 401); 
		 
	    } 
	});

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
