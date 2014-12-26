<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AdminController', 'Controller');

/**
 * CakePHP CategoriesController
 * @author lahore
 */
class CategoriesController extends AdminController {

    public $helpers = array(
        'Time',
        'Tools.Tree',
        'Custom',
        'AuthAcl.Acl'
    );
    
    public $components = array("AjaxHandler");
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->AjaxHandler->handle("add","rename","delete");
    }

    public function index() {
        $this->init("Complaint Categories", "Manage All Complaints Categories");
        $allChildren = $this->Category->children();
        $this->set("data",$allChildren);
    }
    
    public function add(){
        $this->AjaxHandler->response(true);
        if($this->request->is("post")){
            $data = array(
                'Category' => array(
                    'parent_id' => $this->request->data['parent'],
                    'name' => $this->request->data['name']
                )
            );
            $isSaved = $this->Category->save($data);
            echo $isSaved['Category']['id'];
        }
        return $this->AjaxHandler->respond('');
    }
    
    public function rename(){
        $this->AjaxHandler->response(true);
        if($this->request->is("post")){
            $data = array(
                'Category' => array(
                    'id' => $this->request->data['id'],
                    'name' => $this->request->data['name']
                )
            );
            $isSaved = $this->Category->save($data);
            echo $isSaved['Category']['id'];
        }
        return $this->AjaxHandler->respond('');
    }
    
    public function remove(){
        $this->AjaxHandler->response(true);
        if($this->request->is("post")){
            $this->Category->id = $this->request->data["id"];
            if($this->Category->delete()){
                echo "true";
            }
        }
        return $this->AjaxHandler->respond('');
    }
    

}
