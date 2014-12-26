<?php
App::uses('AdminController', 'Controller');

class AuthAclAppController extends AdminController {
    
    var $layout = 'admin';
    
    public function beforeFilter() {
        parent::beforeFilter();
                $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login','plugin' =>'auth_acl');
		$this->Auth->loginRedirect = array('controller' => 'auth_acl', 'action' => 'index','plugin'=> 'auth_acl');
		//$this->Auth->loginRedirect = "/";
                //$this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login','plugin'=> 'auth_acl');
                $this->Auth->logoutRedirect = array('controller' => 'user', 'action' => 'login','plugin' => '');

    }
}

