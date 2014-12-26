<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AdminController', 'Controller');

/**
 * CakePHP UsersController
 * @author lahore
 */
class UserController extends AdminController {

    public $helpers = array(
        'Time',
        'AuthAcl.Acl'
    );
    public $uses = array("User");
    public function beforeFilter() {
	parent::beforeFilter();
//	$this->Auth->allow('*');
//	$this->Auth->allow('');
        $this->Auth->allow('logout');
	$this->Auth->allow('login');
    }
        
    /*public function login(){
        $this->layout = "login_default";
        if($this->request->is('post')){
            if($this->Auth->login()){
                return $this->redirect($this->Auth->redirectUrl());
            }else{
                $this->set("login","false");
                $this->FlashMessage(3, "Incorrect Username or Password");
            }
        }
    }*/
    
    public function logout(){
        $this->Session->delete('auth_user');
	$this->Cookie->delete('AutoLoginUser');
        return $this->redirect($this->Auth->logout());
    }
    
    public function dashboard(){
        $this->init("Dashboard", "F-WASA Complaint Registration System");
    }
     
    /*
     * Use for temp user registration
     */
    public function login() {
		$this->layout = 'login_default';
		$this->Session->delete('auth_user');
		App::uses('Setting', 'AuthAcl.Model');
		$Setting = new Setting();
		$error = null;

		$general = $Setting->find('first',array('conditions' => array('setting_key' => sha1('general'))));
		if (!empty($general)){
			$general = unserialize($general['Setting']['setting_value']);
		}

		$this->set('general',$general);

		$user = $this->Auth->user();
		if(!empty($user)){
			$this->redirect($this->Auth->redirect());
		}
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				/*if ((int)$this->request->data['User']['remember_me'] == 0){
					$this->Cookie->delete('AutoLoginUser');
				}else{
					$this->Cookie->write('AutoLoginUser', $this->Auth->user(), true, '+2 weeks');
				}*/
                                $user = $this->Auth->user();
                                if($user){
                                    $group = $this->User->find('first',array('conditions'=>array('User.id'=>$user['id']),'recursive'=>1));
                                    Cache::write('group_name', $group['Group'][0]['name']);
                                    $group_name = $group['Group'][0]['name'];
                                }
                                if($group_name ==  'CMC' || $group_name == 'Director' || $group_name == 'Manager' || $group_name == 'Administrator'){
                                    $this->redirect('/dashboards/cmc');
                                }else if($group_name == 'Subdivision'){
                                     $this->redirect('/dashboards/subdivisions');
                                }
				$this->redirect($this->Auth->redirect());
			} else {
				$error = __('Your username or password was incorrect.');
			}
		}
		$this->set('error',$error);
	}
   /* public function insertUser(){
        $this->autoRender = false;
        $user = array(
            "User" => array(
                //"id" => 1,  
                "name" => "Salman Yousaf",
                "username" => "splashing",
                "password" => "police123",
                "email" => "salman.yosuaf47@gmail.com",
                "phone" => "03214032644",
                "address" => "Garden Town Lahore",
                "city" => "lahore",
                "role_id" => 1
            )
        );
        if($this->User->save($user)){
            echo "inserted";
        }else{
            echo "error";
        }
    }*/

}
