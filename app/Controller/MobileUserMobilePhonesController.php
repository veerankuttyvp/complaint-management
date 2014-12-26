<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ComplaintsController
 *
 * @author lahore
 */
App::uses('AdminController', 'Controller');
App::uses('CakeTime', 'Utility');
class MobileUserMobilePhonesController extends AdminController{
    
    public $uses = array("MobileUserMobilePhone","Sudivision","MobilePhone");
    public $helpers = array(
	'Form' => array('className' => 'Bs3Helpers.Bs3Form'),
        'Time',
        'AuthAcl.Acl'
    );

    
    public function index(){
    	$this->init("Mobile User Mobile Phones", "Manage all mobile user mobile phones");
        // $data = $this->MobileUserMobilePhone->find("all");print_r($data);
        // die();
        //$this->MobileUserMobilePhone->Behaviors->load('Containable');
        //$containable = array('');
        $this->set("mobileusermobilephones",$this->MobileUserMobilePhone->find("all"));
    	
    }
    public function view($id = null){


      

    }
    public function add(){
        App::uses('Subdivision', 'Model');
        App::uses('MobileUser', 'Model');
        if($this->request->is("post")){
            $post_data = $this->request->data;
            
            if(($post_data['MobileUserMobilePhone']['mobile_user_id']) !="No user available"){
                $MobileUser = new MobileUser();
                $mobile_user = $MobileUser->find('first',array('conditions' => array('MobileUser.id' => $post_data['MobileUserMobilePhone']['mobile_user_id'])));
                $post_data['MobileUserMobilePhone']['user_id'] = $mobile_user['MobileUser']['user_id'];
                unset($post_data['subdivision']);
                
                    if($this->MobileUserMobilePhone->save($post_data)){
                        $this->FlashMessage("0", "Mobile user mobile phone has been added successfully");
                        $this->redirect(array("action"=>"index"));
                    }else{
                        $this->FlashMessage("3");
                    }
                
            } else{
                $this->FlashMessage("3","mobile_user_id not selected");
            }
        }
 
                $Subdivision = new Subdivision();
                $subdivisions = $Subdivision->find('all',array('conditions' => array()));

                $mobile_phones = $this->MobileUserMobilePhone->MobilePhone->find('list',array('fields'=>array('id','mobile')));
 
                
                $this->init("Mobile User Mobile Phones", "Add New mobile user mobile phones");
                $this->set(compact('subdivisions','mobile_phones'));
 
        
    }

     public function delete($id){
        App::uses('Complaint', 'Model');
        
        if($this->MobileUserMobilePhone->exists($id)){
            $Complaint = new Complaint();
            $Complaint->Behaviors->load('Containable');
        $Complaint->contain(array('Consumer','ComplaintStatus','Category','Subdivision','User','ComplaintPriority'));
                $complaint = $Complaint->find('first',array('conditions' => array('Complaint.mobile_user_mobile_phone_id' => $id)));
                if(empty($complaint)){
                    if($this->MobileUserMobilePhone->delete($id)){
                        $this->FlashMessage("0", "Mobile user mobile phone has been deleted successfully");   
                    }else{
                       $this->FlashMessage("3"); 
                    }
                    
                } else {
                    $this->FlashMessage("3","Can not delete this entry.");
                }
            // 
        }
        $this->redirect(array("action"=>"index"));
    }
}