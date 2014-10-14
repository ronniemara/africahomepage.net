<?php

namespace Myapp\Response;

use Config;
use Request;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Support\Contracts\JsonableInterface;
use Cookie;
use Session;
use Symfony\Component\HttpFoundation\Cookie as SymfonyCookie;

class MyResponseClass extends IlluminateResponse {

    /**
     * Morph the given content into JSON.
     *
     * @param  mixed   $content
     * @return string
     */
    protected function morphToJson($content) {
        if ($content instanceof JsonableInterface) {
            $content = $content->toJson();
        } else {
            $content = json_encode($content);
        }
        return self::addAngularProtection($content);
    }
    
    public static function addAngularProtection($content) {
         
    if(!Request::ajax()) {
        return $content;
    }
     
    if(Config::get('app.angular_json_protection') === true) {
        return ")]}',".PHP_EOL.$content;
    }
     
    return $content;
}


    public function sendHeaders()
{
    $this->setAngularCookie();
 
    return parent::sendHeaders();
 
}
 
protected function setAngularCookie()
{
    // This is only relevant for an AJAX GET request
    if(!Request::ajax() || !Request::isMethod('get')) {
        return;
    }
     
    // If we have an existing cookie, don't make another
    $existing = Cookie::get('XSRF-TOKEN');
     
    if(!is_null($existing)) {
        return;
    }
     
    // We'll use a simple hash of the existing session token
    $value = md5( Session::token() );
     
    // Add the cookie to our response
    $this->withCookie( new SymfonyCookie('XSRF-TOKEN', $value, 0, $path = '/',null, Request::secure(),false) );
}
}
