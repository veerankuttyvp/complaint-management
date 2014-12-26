<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AdminController', 'Controller');

/**
 * CakePHP MobilePhonesController
 * @author lahore
 */
class MobilePhonesController extends AdminController {

    public $uses = array("MobilePhone");
    public $helpers = array(
	'Form' => array('className' => 'Bs3Helpers.Bs3Form'),
        'Time',
        'AuthAcl.Acl'
    );
    public function index() {
        $this->init("Mobile Phones", "Manage all mobile phones");
        $this->set("phones",$this->MobilePhone->find("all"));
    }
    
    public function edit($id){
        $this->init("Mobile Phones", "Add New mobile phones");
        if($this->request->is("post")){
            $this->MobilePhone->id = $id;
            if($this->MobilePhone->save($this->request->data)){
                $this->FlashMessage("0", "Mobile phone has been updated successfully");
                $this->redirect(array("action"=>"index"));
            }else{
                $this->FlashMessage("3");
            }
        }
        if(!$this->MobilePhone->exists($id)){
            $this->redirect(array("action"=>"index"));
        }
        $this->request->data = $this->MobilePhone->read(null,$id);
    }
    public function add(){
        $this->init("Mobile Phones", "Add New mobile phones");
        if($this->request->is("post")){
            if($this->MobilePhone->save($this->request->data)){
                $this->FlashMessage("0", "Mobile phone has been added successfully");
                $this->redirect(array("action"=>"index"));
            }else{
                $this->FlashMessage("3");
            }
        }
    }
    public function delete($id){
        $this->request->allowMethod("post");
        if($this->MobilePhone->exists($id)){
            if($this->MobilePhone->delete($id)){
                $this->FlashMessage("0", "Mobile phone has been deleted successfully");   
            }else{
               $this->FlashMessage("3"); 
            }
        }
        $this->redirect(array("action"=>"index"));
    }

}
