<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    	public $components = array(
			'Acl',
			'Auth' => array(
					'authorize' => 'Controller',
					'authenticate' => array(
							'Form' => array(
									'fields' => array('username' => 'user_email',
											'password' => 'user_password'),
									'scope' => array('`User`.`user_status`' => 1)
							),
					),
			),
			'Session',
			'Cookie'
	);
    
    public function beforeFilter() {
        parent::beforeFilter();
      $this->Auth->allow();
       // $this->Auth->allow("*");
        $this->Auth->loginRedirect = "/";
        $this->Auth->authError = "You are not allowed to access this resource!!!";
        
    }
    
    public function FlashMessage($type,$msg = ""){
        $temp = $msg;
        $msg = '<button type="button" class="close" data-dismiss="alert">×</button>' . '<center><b>'.$msg.'</b></center>';
        switch ($type){
            case '0':
                $this->Session->setFlash($msg, "default", array('class'=>'alert alert-success'));
                break;
            case '1':
                $this->Session->setFlash($msg, "default", array('class'=>'alert alert-info'));
                break;
            case '2':
                $this->Session->setFlash($msg, "default", array('class'=>'alert alert-warning'));
                break;
            case '3':
                if($temp == ""){
                    $this->Session->setFlash('An error has been occur! Please Try Again.', "default", array('class'=>'alert alert-danger'));
                }else{
                    $this->Session->setFlash($msg, "default", array('class'=>'alert alert-danger'));
                }
                break;
        }
    }
    
    protected function init($heading,$one_linner){
        $this->set("heading",$heading);
        $this->set("one_linner",$one_linner);
    }


    public function beforeRender() {
        parent::beforeRender();
        $this->set("title_for_layout","::F-WASA Complaint Registration System::");
    }
    
    
}
