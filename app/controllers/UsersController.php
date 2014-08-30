<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsersController
 *
 * @author ron
 */
class UsersController extends BaseController {
    protected $user = null;
    protected $permissions = null;
    
    public function __construct()
    {
        $this->user = \App::make('authenticator');
        $this->permissions = \App::make('authentication_helper');
    }
    
    
    protected function check_permissions(array $permissions)
    {
        return $this->permissions->hasPermissions($permissions);
    }
            
}
