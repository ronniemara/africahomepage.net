<?php

use Cartalyst\Sentry\Users\Eloquent\User as SentryUser;


class User extends SentryUser  {

	public  function __construct()
	{
		return 'In User class';
	}
        
}
