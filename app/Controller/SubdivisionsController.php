<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SubdivisionsController
 *
 * @author lahore
 */
App::uses('AdminController', 'Controller');
class SubdivisionsController extends AdminController{
    
    public $helpers = array(
	'Form' => array('className' => 'Bs3Helpers.Bs3Form'),
        'Time',
        'AuthAcl.Acl'
    );
    
    
    public $uses = array("Subdivision","Group");

    
    public function index(){
        $this->init("Subdivisions", "Manage Subdivision Here");
        $this->set("subdivisions",$this->Subdivision->find("all"));
    }
    
    public function add(){
        $this->init("Subdivisions", "Add Subdivision Here");
        if($this->request->is("post")){
//            $this->request->data['Subdivision']['user_id'] = AuthComponent::user("id");
            if($this->Subdivision->save($this->request->data)){
                $this->FlashMessage("0", "Subdivison has been added successfully");
                $this->redirect(array("action"=>"index"));
            }else{
                $this->FlashMessage("3");
            }
        }
        $group_users = $this->Group->find("first",array("conditions"=>array("Group.id"=>8)));
        $this->set("group_users",$this->Subdivision->makeASDList($group_users, -1));
    }
    
    public function edit($id){
        $this->init("Subdivisions", "Edit Subdivision Here");
        if($this->request->is("post")){
            $this->Subdivision->id = $id;
            if($this->Subdivision->save($this->request->data)){
                $this->FlashMessage("0", "Subdivison has been updated successfully");
                $this->redirect(array("action"=>"index"));
            }else{
                $this->FlashMessage("3");
            }
        }
        if(!$this->Subdivision->exists($id)){
            $this->redirect(array("action"=>"index"));
        }
        $this->request->data = $this->Subdivision->read(null,$id);
        $group_users = $this->Group->find("first",array("conditions"=>array("Group.name"=>'Subdivision')));
        $this->set("group_users",$this->Subdivision->makeASDList($group_users, -1));
    }
    
    public function delete($id){
        $this->request->allowMethod("post");
        if($this->Subdivision->exists($id)){
            if($this->Subdivision->delete($id)){
                $this->FlashMessage("0", "Subdivison has been deleted successfully");   
            }else{
               $this->FlashMessage("3"); 
            }
        }
        $this->redirect(array("action"=>"index"));
    }
    
    public function view($id){
        if($this->Subdivision->exists($id)){
            $this->Subdivision->contain(array("User",'MobileUser','MobileUser.User','MobileUser.MobileUserMobilePhone'));
            $sub = $this->Subdivision->read(null,$id);
            // print_r($sub);die();
            $this->set("subdivision",$sub);
            $this->init("Subdivision Detail", $sub['Subdivision']['name']);
        }else{
            $this->redirect(array("action"=>"index"));
        }
    }
    public function get_mobile_users($id){
        if($this->Subdivision->exists($id)){
            $this->Subdivision->contain(array("User",'MobileUser'));
            $sub = $this->Subdivision->find("all",array("conditions"=>array("Subdivision.id"=>$id)));
            
            foreach ($sub as $value) {
                   
                if (!empty($value['MobileUser'])) {

                    foreach ($value['MobileUser'] as $mobile_user) {
                        echo "<option value=".$mobile_user['id'].">".$mobile_user['id']."</option>";
                        
                    }
                }else{
                        echo "<option value=''>No user available</option>";      
                }
            }
            die();
            
        }

    }
}
