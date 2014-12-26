<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AdminController', 'Controller');

/**
 * CakePHP MobileUsersController
 * @author lahore
 */
class MobileUsersController extends AdminController {

    public $uses = array("MobileUser","Subdivision","Group","MobileUserMobilePhone", "User","MobilePhone");
    public $components = array("AjaxHandler");
    public $helpers = array(
    'Form' => array('className' => 'Bs3Helpers.Bs3Form'),
        'Time',
        'AuthAcl.Acl'
    );
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->AjaxHandler->handle("getUnAssignedMobileUsers","add_mobile_user","mobile_detail");
    }

    public function getUnAssignedMobileUsers() {
        $this->AjaxHandler->response(true);
        if($this->request->is("post")){
            $view = new View($this);
            $elem_html = $view->element("PopupModals/mobile_users",array("mobile_users"=>$this->MobileUser->getUnAssignedMobileUsers()));
            echo $elem_html;
        }
        return $this->AjaxHandler->respond('');
    }
    
    public function add_mobile_user(){
        $this->AjaxHandler->response(true);
        if($this->request->is("post")){
            $user_id = $this->request->data['mobile_users'];
            $center_name = $this->request->data['center_name'];
                $this->MobileUser->create();
                $data = array(
                    "MobileUser" => array(
                        "user_id" => $user_id,
                        "subdivision_id" => $this->request->data['subdivision_id'],
                        "center_name" => $center_name
                    )
                );
                $this->MobileUser->save($data);
        }
        return $this->AjaxHandler->respond('');
    }
    
    public function delete($id){
            $this->request->allowMethod("post");
            $this->MobileUser->recursive = -1;
            $mobile_user = $this->MobileUser->find('first',array("conditions"=>array("MobileUser.user_id"=>$id)));  
            if($mobile_user){
                if($this->MobileUser->delete($mobile_user['MobileUser']['id'])){
                    $this->FlashMessage("0", "Mobile user has been deleted successfully");   
                }else{
                   $this->FlashMessage("3"); 
                }
            }
            $this->redirect($this->referer());
    }
    
    public function user_change($mobile_user_id){
        $this->AjaxHandler->response(true);
        if($this->request->is("post")){
            $center_id =$this->request->data["center_id"];
            $subdivision_id =$this->request->data["subdivision_id"];

           
            $view = new View($this);
            // print_r($mobile_user_id);die();
            $mobile_det_elem_html = $view->element('PopupModals/change_user',array("subdivision_id" => $subdivision_id,"center_id" => $center_id,"mobile_user_id_actual"=>$mobile_user_id,"mobile_users"=>$this->MobileUser->getUnAssignedMobileUsers()));
            echo $mobile_det_elem_html;
        }
        return $this->AjaxHandler->respond(''); 
    }
    public function change_user(){
        if($this->request->is("post")){
            $mobile_phone_id_list  = array( );
            // print_r($this->request->data["mobile_users"]);echo "<br>";
            // print_r($this->request->data["center_id"]);
            $mobile_user_mobile_phones_new_ids = $this->MobileUserMobilePhone->find("all",array("conditions"=>array("MobileUserMobilePhone.user_id"=>$this->request->data["mobile_users"])));
            $mobile_user_mobile_phones_olds= $this->MobileUserMobilePhone->find("all",array("conditions"=>array("MobileUserMobilePhone.mobile_user_id"=>$this->request->data["center_id"])));
            foreach ($mobile_user_mobile_phones_new_ids as  $mobile_user_mobile_phones_new_id) {
                array_push($mobile_phone_id_list,$mobile_user_mobile_phones_new_id['MobileUserMobilePhone']['mobile_phone_id']);
                 
             } 
              foreach ($mobile_user_mobile_phones_olds as  $mobile_user_mobile_phones_old) {
                array_push($mobile_phone_id_list,$mobile_user_mobile_phones_old['MobileUserMobilePhone']['mobile_phone_id']);
                 
             }
            // print_r($mobile_phone_id_list); die();
             if (count(array_unique($mobile_phone_id_list)) === 1 && count($mobile_phone_id_list) != 0) {

                $this->MobileUser->updateAll(array('MobileUser.user_id' =>$this->request->data["mobile_users"]), array('MobileUser.id' => $this->request->data["center_id"]));
                $this->MobileUserMobilePhone->updateAll(array('MobileUserMobilePhone.user_id' =>$this->request->data["mobile_users"]), array('MobileUserMobilePhone.mobile_user_id' => $this->request->data["center_id"]));
                     $this->FlashMessage(0, "Mobile User has been changed successfully"); 

            } else{
                   $this->FlashMessage(3,"same user is assigned to different mobiles also");  
            }
            $this->redirect(array("controller" => "subdivisions",'action' => 'view', $this->request->data["subdivision_id"]));

            // $this->MobileUser->updateAll(array('MobileUser.user_id' =>$this->request->data["mobile_users"]), array('MobileUser.id' => $this->request->data["center_id"]));
            die();
            
        }
        
    }


    public function mobile_detail($mobile_user_id,$action = ''){

        $this->AjaxHandler->response(true);
        if($this->request->is("post")){
            //$all_unassigned_phones = $this->MobileUser->MobileUserMobilePhone->getUnAssinedMobilePhones();
            $all_mobile_users = $this->MobilePhone->find('all');
            $assignedMobileId = $this->MobileUserMobilePhone->find("first",array("conditions"=>array("MobileUser.id"=>$mobile_user_id)));
            if($assignedMobileId){
                $mobileId = $assignedMobileId['MobileUserMobilePhone']['mobile_phone_id'];
            }else{
                $mobileId = '';
            }
            $all_unassigned_phones = array();
            foreach ($all_mobile_users as $phone){
                $all_unassigned_phones[$phone['MobilePhone']['id']] = $phone['MobilePhone']['mobile'];
            }
            $this->MobileUser->contain(array("MobileUserMobilePhone","User","MobileUserMobilePhone.MobilePhone"));
            $mobile_detail = $this->MobileUser->find("first",array("conditions"=>array("MobileUser.id"=>$mobile_user_id)));
            $view = new View($this);
            if(!$action){
                $mobile_det_elem_html = $view->element('PopupModals/mobile_details',array("mobile_user_id_actual"=>$mobile_user_id,"mobiles"=>$all_unassigned_phones,"user"=>$mobile_detail["User"],"mobile_numbers"=>$mobile_detail["MobileUserMobilePhone"],"assignedMobileId"=>$mobileId));
            }else{

                $mobile_det_elem_html = $view->element('PopupModals/mobile_details_update',array("mobile_user_id_actual"=>$mobile_user_id,"mobiles"=>$all_unassigned_phones,"user"=>$mobile_detail["User"],"mobile_numbers"=>$mobile_detail["MobileUserMobilePhone"],"assignedMobileId"=>$mobileId));
            }

            echo $mobile_det_elem_html;
        }
        return $this->AjaxHandler->respond('');  
    }
    
    public function add_mobile(){
        if($this->request->is("post")){
            $mobile_user_id = $this->MobileUser->find("first",array("conditions"=>array("MobileUser.user_id"=>$this->request->data["user_id"])));
            $this->request->data["MobileUserMobilePhone"]['mobile_user_id'] = $this->request->data["mobile_user_id"];
            $this->request->data["MobileUserMobilePhone"]['user_id'] = $this->request->data["user_id"];
            $mobile_id = $this->request->data['MobileUserMobilePhone']['mobile_phone_id'];
            
            $mobileDetail = $this->MobileUserMobilePhone->find('first',array('conditions'=>array('MobileUserMobilePhone.mobile_phone_id'=> $mobile_id)));
            if($mobileDetail){
                    if($mobileDetail['MobileUserMobilePhone']['user_id'] != $this->request->data["user_id"]){
                        $this->FlashMessage(3,"Mobile already assigned to a user");
                        
                    }
            }else{
                if($this->MobileUserMobilePhone->save($this->request->data)){
                    $this->FlashMessage(0, "Mobile Phone has been add successfully");
                }else{
                    $this->FlashMessage(3);
                }
            }
        }
        $this->redirect($this->referer());
    }
    public function update_mobile(){
        if($this->request->is("post")){
            $mobile_user_id = $this->MobileUser->find("first",array("conditions"=>array("MobileUser.user_id"=>$this->request->data["user_id"])));
            $this->request->data["MobileUserMobilePhone"]['mobile_user_id'] = $this->request->data["mobile_user_id"];
            //$this->request->data["MobileUserMobilePhone"]['user_id'] = $this->request->data["user_id"];
            $userId = $this->request->data["user_id"];
            $mobile_id = $this->request->data['MobileUserMobilePhone']['mobile_phone_id'];
            $prevMobile = $this->request->data['assigned_mobile'];
            $mobileDetail = $this->MobileUserMobilePhone->find('all',array('conditions'=>array('MobileUserMobilePhone.mobile_phone_id'=> $prevMobile,'MobileUserMobilePhone.user_id'=>$userId)));            
            $mobileCheckDetil = $this->MobileUserMobilePhone->find('first',array('conditions'=>array('MobileUserMobilePhone.mobile_phone_id'=> $mobile_id)));
            $mobileUserMobId = $mobileDetail[0]['MobileUserMobilePhone']['id'];      
            $this->request->data['MobileUserMobilePhone']['id'] = $mobileUserMobId;           
            if($mobileDetail){
                if($mobileCheckDetil){
                    if($mobileCheckDetil['MobileUserMobilePhone']['user_id'] != $this->request->data["user_id"]){
                        $this->FlashMessage(3,"Mobile already assigned to a user");
                    }else{
                        if($this->MobileUserMobilePhone->save($this->request->data)){
                            $this->FlashMessage(0, "Mobile Phone has been updated successfully");
                        }else{
                            $this->FlashMessage(3);
                        }
                    }
                }else{
                       if($this->MobileUserMobilePhone->save($this->request->data)){
                            $this->FlashMessage(0, "Mobile Phone has been updated successfully");
                        }else{
                            $this->FlashMessage(3);
                        }
                }    
            }
        }
        $this->redirect($this->referer());
    }


    public function deleteMobilePhone($id){
        $this->request->allowMethod("post");
        if($this->MobileUserMobilePhone->exists($id)){
            if($this->MobileUserMobilePhone->delete($id)){
                $this->FlashMessage(0, "Mobile Phone has been deleted successfully");
            }else{
                $this->FlashMessage(3);
            }
        }
        $this->redirect($this->referer());
    }
    
    
    public function add(){
        
       // These are the heading part of the page.
        $heading = 'Mobile User';
        $one_linner = 'Add Mobile User.';
        
        if($this->request->is("post")){
            
            // Check for user id and show error,
            $user = $this->MobileUser->find('first',array('conditions'=>array('MobileUser.user_id'=>$this->request->data['MobileUser']['user_id'])));
            
            if( $user ){
                
                 $this->FlashMessage("3", "User already exists");
                 
            }elseif($this->MobileUser->save($this->request->data)){
                
                $this->FlashMessage("0", "Mobile User has been added successfully");
                $this->redirect(array("action"=>"index"));
                
            }else{
                
                $this->FlashMessage("3");
                
            }
        }
        
        $users = $this->User->find('list',array('fields'=>array('id','user_name')));
        $subdivisions = $this->Subdivision->find('list',array('fields'=>array('id','name')));
        
        $this->set(compact("users","subdivisions","heading","one_linner"));
    }
    
    
    public function index(){
        
        // These are the heading part of the page.
        $heading = 'Mobile USer';
        $one_linner = 'Listing All Mobile User.';
        
        // Get all Mobile users.
        
        $Users = $this->MobileUser->find('all');
        
        $this->set(compact('Users',"heading","one_linner"));
        
    }
    
    
    public function userdelete($id){
            $this->MobileUser->recursive = -1;
            $mobile_user = $this->MobileUser->find('first',array("conditions"=>array("MobileUser.id"=>$id)));  
            if($mobile_user){
                if($this->MobileUser->delete($mobile_user['MobileUser']['id'])){
                    $this->FlashMessage("0", "Mobile user has been deleted successfully");   
                }else{
                   $this->FlashMessage("3"); 
                }
            }
            $this->redirect($this->referer());
    }
    

}