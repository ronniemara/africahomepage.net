<?php namespace Myapp\Response;

use Illuminate\Support\Contracts\JsonableInterface;
use Illuminate\Http\JsonResponse as IlluminateResponse;
use Cookie;
use Session;
use Symfony\Component\HttpFoundation\Cookie as SymfonyCookie;

class MyJsonResponseClass extends IlluminateResponse {

	
	/**
	 * {@inheritdoc}
	 */
	public function setData($data = array())
	{
		$this->data = $data instanceof JsonableInterface ? $data->toJson() :    json_encode($data);
                
                $this->data = MyResponseClass::addAngularProtection($this->data);
     
                return $this->update();
	}
         public function sendHeaders()
{
    $this->setAngularCookie();
 
    return parent::sendHeaders();
 
}
 
protected function setAngularCookie()
{
    // This is only relevant for an AJAX GET request
    if(!\Request::ajax() || !\Request::isMethod('get')) {
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
    $this->withCookie( new SymfonyCookie('XSRF-TOKEN', $value, 0, $path = '/',null, \Request::secure(),false) );
}

	
}

