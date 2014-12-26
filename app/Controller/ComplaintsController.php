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
class ComplaintsController extends AdminController{
    
    public $uses = array("Complaint","ComplaintStatus",'MobileUser','SubDivision');
    public $helpers = array(
    'Form' => array('className' => 'Bs3Helpers.Bs3Form'),
        'Time',
        'AuthAcl.Acl'
    );
    public $categories_list  = array();

    
    public function index(){
        
        $condition = array();
        
        // These are the heading part of the page.
        $heading = 'Complaints';
        $one_linner = 'Listing All Complaints.';
        
        // Get list of status.
        $status = $this->Complaint->ComplaintStatus->find('list',array('fields'=>array('id','status')));

        
        if( $this->request->is('post') or $this->request->is('put')){
            if($this->request->data['Complaint']['complaint_status_id'] != ''){
                $condition['Complaint.complaint_status_id'] = $this->request->data['Complaint']['complaint_status_id'];
            }
        }
        
        // get all complaints and sent it to view.
        $this->Complaint->Behaviors->load('Containable');
        $this->Complaint->contain(array('Consumer','ComplaintStatus','Category.name','Subdivision.name'));
        $complaints = $this->Complaint->find('all',array('conditions'=>$condition));
    
        $this->set(compact('complaints','heading','one_linner','status'));
        
    }
    
    public function cmc_operator(){
        
        $condition = array();
        
        // These are the heading part of the page.
        $heading = 'Complaints';
        $one_linner = 'Listing All Complaints.';
        
        // Get list of status.
        $status = $this->Complaint->ComplaintStatus->find('list',array('fields'=>array('id','status')));
        $subdivisions = $this->Complaint->Subdivision->find('list',array('fields'=>array('id','name')));

        
        if( $this->request->is('post') or $this->request->is('put')){
            if(isset($this->request->data['Complaint']['complaint_status_id']) and $this->request->data['Complaint']['complaint_status_id'] != ''){
                $condition['Complaint.complaint_status_id'] = $this->request->data['Complaint']['complaint_status_id'];
            }
            if(isset($this->request->data['Complaint']['category_id']) and $this->request->data['Complaint']['category_id'] != ''){
                $condition['Complaint.category_id'] = $this->request->data['Complaint']['category_id'];
            }
            if(isset($this->request->data['Complaint']['subdivision_id']) and $this->request->data['Complaint']['subdivision_id'] != ''){
                $condition['Complaint.subdivision_id'] = $this->request->data['Complaint']['subdivision_id'];
            }
                
            if(isset($this->request->data['Complaint']['date_range']) and $this->request->data['Complaint']['date_range'] != ''){
                    $range = explode('-',$this->request->data['Complaint']['date_range']);
                    $range[0] = date('Y-m-d H:i:s',  strtotime($range[0]));
                    $range[1] = date('Y-m-d H:i:s',  strtotime($range[1]));
                $condition['Complaint.created  between ? and ?'] = $range;
            }
        }
        $parent_categories = $this->Complaint->Category->children(1,true);

        $categories = array();
        
        // Generate all categories as list.
        foreach ($parent_categories as $each_parent){
            $categories[$each_parent['Category']['id']] =$each_parent['Category']['name'];
        }
        
        // get all complaints and sent it to view.
        $this->Complaint->Behaviors->load('Containable');
        $this->Complaint->contain(array('Consumer','ComplaintStatus','Category.name','Subdivision.name'));
        $complaints = $this->Complaint->find('all',array('conditions'=>$condition));
    
        $this->set(compact('complaints','heading','one_linner','status','subdivisions','categories'));
        
    }
    public function cmc_operator_new(){
        
        $condition = array();
        
        // These are the heading part of the page.
        $heading = 'Complaints';
        $one_linner = 'Listing All Complaints.';
        
        // Get list of status.
        $status = $this->Complaint->ComplaintStatus->find('list',array('fields'=>array('id','status')));
        $subdivisions = $this->Complaint->Subdivision->find('list',array('fields'=>array('id','name')));

        
        if( $this->request->is('post') or $this->request->is('put')){
            if(isset($this->request->data['Complaint']['complaint_status_id']) and $this->request->data['Complaint']['complaint_status_id'] != ''){
                $condition['Complaint.complaint_status_id'] = $this->request->data['Complaint']['complaint_status_id'];
            }
            if(isset($this->request->data['Complaint']['category_id']) and $this->request->data['Complaint']['category_id'] != ''){
                $condition['Complaint.category_id'] = $this->request->data['Complaint']['category_id'];
            }
            if(isset($this->request->data['Complaint']['subdivision_id']) and $this->request->data['Complaint']['subdivision_id'] != ''){
                $condition['Complaint.subdivision_id'] = $this->request->data['Complaint']['subdivision_id'];
            }
                
            if(isset($this->request->data['Complaint']['date_range']) and $this->request->data['Complaint']['date_range'] != ''){
                    //$range = explode('-',$this->request->data['Complaint']['date_range']);
                    $range = explode('**',$this->request->data['Complaint']['date_range']);
                    $range[0] = date('Y-m-d H:i:s',  strtotime($range[0]));
                    $range[1] = date('Y-m-d H:i:s',  strtotime($range[1]));
                    $range[1] = str_replace('00:00:00', '23:59:59', $range[1]);
                    //$range[1] = 
                $condition['Complaint.created  between ? and ?'] = $range;
            }
        }
        $parent_categories = $this->Complaint->Category->children(1,true);

        $categories = array();
        
        // Generate all categories as list.
        foreach ($parent_categories as $each_parent){
            $categories[$each_parent['Category']['id']] =$each_parent['Category']['name'];
        }
        
        // get all complaints and sent it to view.
        $this->Complaint->Behaviors->load('Containable');
        $this->Complaint->contain(array('Consumer','ComplaintStatus','Category.name','Subdivision.name'));
        $complaints = $this->Complaint->find('all',array('conditions'=>$condition,'order' => array('Complaint.created' => 'desc')));
        // print_r($complaints);die();
        $this->set(compact('complaints','heading','one_linner','status','subdivisions','categories'));
        
    }
    public function cmc_operator_latest(){
        
        $condition = array();
        
        // These are the heading part of the page.
        $heading = 'Complaints';
        $one_linner = 'Listing All Complaints.';
        
        // Get list of status.
        $status = $this->Complaint->ComplaintStatus->find('list',array('fields'=>array('id','status')));
        $subdivisions = $this->Complaint->Subdivision->find('list',array('fields'=>array('id','name')));

        
        if( $this->request->is('post') or $this->request->is('put')){
            if(isset($this->request->data['Complaint']['complaint_status_id']) and $this->request->data['Complaint']['complaint_status_id'] != ''){
                $condition['Complaint.complaint_status_id'] = $this->request->data['Complaint']['complaint_status_id'];
            }
            if(isset($this->request->data['Complaint']['category_id']) and $this->request->data['Complaint']['category_id'] != ''){
                $condition['Complaint.category_id'] = $this->request->data['Complaint']['category_id'];
            }
            if(isset($this->request->data['Complaint']['subdivision_id']) and $this->request->data['Complaint']['subdivision_id'] != ''){
                $condition['Complaint.subdivision_id'] = $this->request->data['Complaint']['subdivision_id'];
            }
                
            if(isset($this->request->data['Complaint']['date_range']) and $this->request->data['Complaint']['date_range'] != ''){
                    //$range = explode('-',$this->request->data['Complaint']['date_range']);
                    $range = explode('**',$this->request->data['Complaint']['date_range']);
                    $range[0] = date('Y-m-d H:i:s',  strtotime($range[0]));
                    $range[1] = date('Y-m-d H:i:s',  strtotime($range[1]));
                    $range[1] = str_replace('00:00:00', '23:59:59', $range[1]);
                    //$range[1] = 
                $condition['Complaint.created  between ? and ?'] = $range;
            }
        }
        $parent_categories = $this->Complaint->Category->children(1,true);

        $categories = array();
        
        // Generate all categories as list.
        foreach ($parent_categories as $each_parent){
            $categories[$each_parent['Category']['id']] =$each_parent['Category']['name'];
        }
        
        // get all complaints and sent it to view.
        $this->Complaint->Behaviors->load('Containable');
        $this->Complaint->contain(array('Consumer','ComplaintStatus','Category.name','Subdivision.name'));
        $complaints = $this->Complaint->find('all',array('conditions'=>$condition,'order' => array('Complaint.created' => 'desc')));
        // print_r($complaints);die();
        $this->set(compact('complaints','heading','one_linner','status','subdivisions','categories'));
        
    }
    public function complaints_ajax(){



        $this->layout = false;
        $condition=  array( );
        // print_r($this->request->data['Complaint']);die();
        if( $this->request->is('post') or $this->request->is('put')){
                if(isset($this->request->data['Complaint']['complaint_status_id']) and $this->request->data['Complaint']['complaint_status_id'] != ''){
                    $condition['Complaint.complaint_status_id'] = $this->request->data['Complaint']['complaint_status_id'];
                }
                
                if(isset($this->request->data['Complaint']['subdivision_id']) and $this->request->data['Complaint']['subdivision_id'] != ''){
                    $condition['Complaint.subdivision_id'] = $this->request->data['Complaint']['subdivision_id'];
                }
                    
                if(isset($this->request->data['Complaint']['date_range']) and $this->request->data['Complaint']['date_range'] != ''){
                        //$range = explode('-',$this->request->data['Complaint']['date_range']);
                        $range = explode('**',$this->request->data['Complaint']['date_range']);
                        $range[0] = date('Y-m-d H:i:s',  strtotime($range[0]));
                        $range[1] = date('Y-m-d H:i:s',  strtotime($range[1]));
                        $range[1] = str_replace('00:00:00', '23:59:59', $range[1]);
                        //$range[1] = 
                    $condition['Complaint.created  between ? and ?'] = $range;
                }


                //category condition 
                $categories_list  = array( );
                if($this->request->data['Complaint']['parent_category_id'] ==0){

                }else if(($this->request->data['Complaint']['parent_category_id'] !=0) &&  ($this->request->data['Complaint']['child_cat_id'] ==0)){
                    $this->get_all_child_category($this->request->data['Complaint']['parent_category_id']);
                    $categories_list = $this->categories_list;

                    array_push($categories_list,$this->request->data['Complaint']['parent_category_id']);
                    $condition['Complaint.category_id'] = $categories_list;

                }else if(($this->request->data['Complaint']['parent_category_id'] !=0) &&  ($this->request->data['Complaint']['child_cat_id'] !=0)){
                    $this->get_all_child_category($this->request->data['Complaint']['child_cat_id']);
                    $categories_list = $this->categories_list;

                    array_push($categories_list,$this->request->data['Complaint']['child_cat_id']);
                    $condition['Complaint.category_id'] = $categories_list;
                }

                // if(isset($this->request->data['Complaint']['category_id']) and $this->request->data['Complaint']['category_id'] != ''){
                //     $condition['Complaint.category_id'] = $this->request->data['Complaint']['category_id'];
                // }
            
            
            
            $complaints = $this->Complaint->find('all',array('conditions'=>$condition,'order' => array('Complaint.created' => 'desc')));

        } else{





            $complaints = $this->Complaint->find('all',array('order' => array('Complaint.created' => 'desc')));
        }    
        $array  = array();
        $cnt=0;
        foreach ($complaints as $complaint) {
            $cnt++;
            $stack = array();   
            $datetime_created = new DateTime($complaint['Complaint']['created']);
            if($complaint['ComplaintStatus']['status'] == 'Resolved'){
                $status_with_label = '<span class="label label-success">'.$complaint['ComplaintStatus']['status'].'</span>';
            }
            else if($complaint['ComplaintStatus']['status'] == 'Closed By Subengineer'){
                $status_with_label = '<span class="label label-primary">'.$complaint['ComplaintStatus']['status'].'</span>';
            }
            else if($complaint['ComplaintStatus']['status'] == 'Pending'){
                $status_with_label = '<span class="label label-inverse">'.$complaint['ComplaintStatus']['status'].'</span>';
            }else{
                $status_with_label = '<span class="label label-inverse">'.$complaint['ComplaintStatus']['status'].'</span>';

            }
            array_push($stack, $cnt,$complaint['Complaint']['id'],$complaint['Consumer']['first_name'],$complaint['Category']['name'],$complaint['Subdivision']['name'],$complaint['Consumer']['mobile'],$status_with_label);

                    $date_string ='<span class="label label-info">'. $datetime_created->format('Y/M/d h:i:s a').'</span>';          
                    $status_string = '<div class="btn-group">
                                <a href="view/'.$complaint['Complaint']['id']. '"data-toggle="tooltip" title="View" class="btn btn-xs btn-success"><i class="icon-pencil"></i>Details</a>
                        <a href="edit/'.$complaint['Complaint']['id']. '"data-toggle="tooltip" title="Edit" class="btn btn-xs btn-success"><i class="icon-pencil"></i>Edit</a><br>
                        <a class="btn btn-xs btn-success model" href="status_edit/'.$complaint['Complaint']['id'].'" data-toggle="tooltip" title="Change Status" rel="Change Status" ><i class="icon-pencil"></i>Change Status</a>
                    </div>';
            array_push($stack,$date_string,$status_string);        

            array_push($array,$stack);
        }
        $json =  array();
        $json['data'] =  $array;
        echo json_encode($json);
        die();        
    }


    public function subdivision_complaint(){
        
        $condition = array();
        
        // These are the heading part of the page.
        $heading = 'Complaints';
        $one_linner = 'Listing All Complaints.';
        $sub_id;
        if ($this->Auth->loggedIn()) {
            $uid = $this->Auth->user('id');
            $sub_id =0;
            // $uid = 1;
            $mobile_user = $this->MobileUser->find('first',array('conditions'=> array('MobileUser.user_id' => $uid)));
            if(empty($mobile_user)){
                $subdivision = $this->Subdivision->find('first',array('conditions'=> array('Subdivision.user_id' => $uid)));
                if(empty($subdivision)){
                            $view = new View($this, false);
                            $view->set(compact('heading', 'one_linner'));
                            $html = $view->render('error');
                            // $return = $this->render('error');
            
                            echo $html;
                            exit;
                } else {
                   $sub_id =$subdivision['Subdivision']['id'];
                }
            } else {
                $sub_id =$mobile_user['MobileUser']['subdivision_id'];
            }
        }
        // Get list of status.
        $status = $this->Complaint->ComplaintStatus->find('list',array('fields'=>array('id','status')));
//      $subdivisions = $this->Complaint->Subdivision->find('list',array('fields'=>array('id','name')));

        
        if( $this->request->is('post') or $this->request->is('put')){
            if($this->request->data['Complaint']['complaint_status_id'] != ''){
                $condition['Complaint.complaint_status_id'] = $this->request->data['Complaint']['complaint_status_id'];
            }
            if(isset($this->request->data['Complaint']['category_id']) && $this->request->data['Complaint']['category_id'] != ''){
                $condition['Complaint.category_id'] = $this->request->data['Complaint']['category_id'];
            }
//          if($this->request->data['Complaint']['subdivision_id'] != ''){
                $condition['Complaint.subdivision_id'] = $sub_id;
//          }
                
            if($this->request->data['Complaint']['date_range'] != ''){
                    //$range = explode('-',$this->request->data['Complaint']['date_range']);
                    $range = explode('**',$this->request->data['Complaint']['date_range']);
                    $range[0] = date('Y-m-d H:i:s',  strtotime($range[0]));
                    $range[1] = date('Y-m-d H:i:s',  strtotime($range[1]));
                    $range[1] = str_replace('00:00:00', '23:59:59', $range[1]);
                $condition['Complaint.created  between ? and ?'] = $range;
            }
        }
        $parent_categories = $this->Complaint->Category->children(1,true);

        $categories = array();
        
        // Generate all categories as list.
        foreach ($parent_categories as $each_parent){
            $categories[$each_parent['Category']['id']] =$each_parent['Category']['name'];
        }
        
        // get all complaints and sent it to view.
        $this->Complaint->Behaviors->load('Containable');
        $this->Complaint->contain(array('Consumer','ComplaintStatus','Category.name','Subdivision.name'));
        $complaints = $this->Complaint->find('all',array('conditions'=>$condition));
    
        $this->set(compact('complaints','heading','one_linner','status','subdivisions','categories'));
        
    }
    public function cmc_operator_ajax(){
        $this->layout = 'ajax';
        $condition = array();
        
        // These are the heading part of the page.
        $heading = 'Complaints';
        $one_linner = 'Listing All Complaints.';
        
        // Get list of status.
        $status = $this->Complaint->ComplaintStatus->find('list',array('fields'=>array('id','status')));
        $subdivisions = $this->Complaint->Subdivision->find('list',array('fields'=>array('id','name')));

        
        if( $this->request->is('post') or $this->request->is('put')){
//            print_r($this->request->data);exit;
            if($this->request->data['Complaint']['complaint_status_id'] != ''){
                $condition['Complaint.complaint_status_id'] = $this->request->data['Complaint']['complaint_status_id'];
            }
            if($this->request->data['Complaint']['subdivision_id'] != ''){
                $condition['Complaint.subdivision_id'] = $this->request->data['Complaint']['subdivision_id'];
            }
        }
        
        // get all complaints and sent it to view.
        $this->Complaint->Behaviors->load('Containable');
        $this->Complaint->contain(array('Consumer','ComplaintStatus','Category.name','Subdivision.name'));
        $complaints = $this->Complaint->find('all',array('conditions'=>$condition));
    
        $this->set(compact('complaints','heading','one_linner','status','subdivisions'));
        
    }
    
    public function subdivision(){
        
        $condition = array();
        
        // These are the heading part of the page.
        $heading = 'Complaints';
        $one_linner = 'Listing All Complaints.';
        
        // Get list of status.
        $status = $this->Complaint->ComplaintStatus->find('list',array('fields'=>array('id','status')));

        
        if( $this->request->is('post') or $this->request->is('put')){
            if($this->request->data['Complaint']['complaint_status_id'] != ''){
                $condition['Complaint.complaint_status_id'] = $this->request->data['Complaint']['complaint_status_id'];
            }
        }
        
        // get all complaints and sent it to view.
        $this->Complaint->Behaviors->load('Containable');
        $this->Complaint->contain(array('Consumer','ComplaintStatus','Category.name','Subdivision.name'));
        $complaints = $this->Complaint->find('all',array('conditions'=>$condition));
    
        $this->set(compact('complaints','heading','one_linner','status','subdivisions'));
        
    }
    
     public function register(){ 
        
        // These are the heading part of the page.
        $heading = 'Register Complaint';
        $one_linner = 'Please fill the form to register your complaint.';
        
        // Get all parent categories to 1.
        $parent_categories = $this->Complaint->Category->children(1,true);

        $categories = array();
        
        // Generate all categories as list.
        foreach ($parent_categories as $each_parent){
            $categories[$each_parent['Category']['id']] =$each_parent['Category']['name'];
        }
        
        $categories['0'] = 'Other';
        
        //Get all sudivisions list
        $subdivisions = $this->Complaint->Subdivision->find('list');
        
        
        // Get complaint status.
        $complaint_status = $this->Complaint->ComplaintStatus->find('list',array('fields'=>array('id','status')));
        
        // Get complaint list.
        $colonies  = $this->Complaint->ColonyName->find('list',array('fields'=>array('id','colony_name'),'order'=>array('colony_name ASC')));;
        
        // Get company priorities.
        $complaint_priorities = $this->Complaint->ComplaintPriority->find('list',array('fields'=>array('id','priority')));
        
        if( $this->request->is('post') ){

            $complaint = $this->request->data['Complaint'];
            $complaint['user_id'] = $this->Auth->user('id');
            
            // GEt asigned user id.
            $complaint['assigned_user'] =  $this->Complaint->MobileUserMobilePhone->getAssignedUser($complaint['mobile_user_mobile_phone_id']);
            
            $data_complaint = $this->Complaint->save($complaint);
            $complaint_id = $this->Complaint->id;
            if($data_complaint){
                $consumer = $this->request->data['Consumer'];
                $consumer['bill_number'] =  $data_complaint['Complaint']['bill_no'];
                // CHeck bill number
                $this->Complaint->Consumer->id = $this->Complaint->Consumer->checkConsumerExisting($consumer['bill_number']);
                $this->Complaint->Consumer->save($consumer);
                $id = $this->Complaint->Consumer->id;
                $data_complaint = $this->request->data['Complaint'];
                $data_complaint['consumer_id'] = $id;
                $this->Complaint->save($data_complaint);
                $this->loadModel('ComplaintNotification');
                $this->ComplaintNotification->pushNotification( $this->Complaint->id, 'New Complaint','New' );
                $this->FlashMessage("0", "Your complaint has been registered successfully");
                
                $this->redirect(array("action"=>"thankyou",$complaint_id));
            }else{
                $this->FlashMessage("3");
            }
        }
        
        $this->set(compact('heading','one_linner','categories','subdivisions','complaint_status','complaint_priorities','colonies'));
        
    }
    public function thankyou( $id = false){
        $heading = 'Thank You';
        $one_linner = 'Thank you for registering complaint here.';

        $this->set(compact('heading','one_linner','id'));

    }

    public function complaint_map(){

        $this->layout = 'dashboard';
        $heading = 'Complaints';
        $one_linner = 'Thank you for registering complaint here.';

        // Get list of status.
        $status = $this->Complaint->ComplaintStatus->find('list',array('fields'=>array('id','status')));
        $subdivisions = $this->Complaint->Subdivision->find('list',array('fields'=>array('id','name')));

        
        if( $this->request->is('post') or $this->request->is('put')){
            
           $categories_list  = array( );
                if($this->request->data['Complaint']['parent_category_id'] ==0){

                }else if(($this->request->data['Complaint']['parent_category_id'] !=0) &&  ($this->request->data['Complaint']['child_cat_id'] ==0)){
                    $this->get_all_child_category($this->request->data['Complaint']['parent_category_id']);
                    $categories_list = $this->categories_list;

                    array_push($categories_list,$this->request->data['Complaint']['parent_category_id']);
                    $condition['Complaint.category_id'] = $categories_list;

                }else if(($this->request->data['Complaint']['parent_category_id'] !=0) &&  ($this->request->data['Complaint']['child_cat_id'] !=0)){
                    $this->get_all_child_category($this->request->data['Complaint']['child_cat_id']);
                    $categories_list = $this->categories_list;

                    array_push($categories_list,$this->request->data['Complaint']['child_cat_id']);
                    $condition['Complaint.category_id'] = $categories_list;
                }
                // print_r($categories_list);die();
        }
        $condition['Complaint.lat <>'] =0;
        $condition['Complaint.longi <>'] =0;
        $parent_categories = $this->Complaint->Category->children(1,true);
        $categories = array();      
        // Generate all categories as list.
        foreach ($parent_categories as $each_parent){
            $categories[$each_parent['Category']['id']] =$each_parent['Category']['name'];
        }
        // get all complaints and sent it to view.
        $this->Complaint->Behaviors->load('Containable');
        $this->Complaint->contain(array('Consumer','ComplaintStatus','Category.name','Subdivision.name'));
        $complaints = $this->Complaint->find('all',array('conditions'=>$condition,'order' => array('Complaint.created' => 'desc')));
        $this->set(compact('heading','complaints','categories'));
    }
    
    
    
    public function getchildencat( $id = false){
        
        $this->layout = false;
        
        if( $id !== false ){
            
            // Get all parent categories to 1.
            $parent_categories = $this->Complaint->Category->children($id,true);
            
            if(empty($parent_categories)){
                echo "fail";
                exit;
            } 
            
            $categories = array();
            
            // Generate all categories as list.
            foreach ($parent_categories as $each_parent){
                $categories[$each_parent['Category']['id']] =$each_parent['Category']['name'];
            }
            
            $this->set(compact('categories','id'));
            
            $return = $this->render('category_select');
            
            echo $return;
            exit;
            
        }
        
        echo "fail";
        exit;
        
    }
    
    
    
    public function getmobile_users( $id = false ){
        
        $this->layout = false;
        
        if( $id !== false ){
            
            // Get the users based in sundivision id.<br>
            $this->loadModel('MobileUser');
            $mobile_users = $this->MobileUser->find('list',array('conditions'=>array('MobileUser.subdivision_id'=>$id),
                                                                            'fields'=>array('id','id')));
            
            // Select mobile users from mobile user mobile phone.
            $this->loadModel('MobileUserMobilePhone');                  
            $mobile_phone = $this->MobileUserMobilePhone->find('all',array('conditions'=>array('MobileUserMobilePhone.mobile_user_id'=>$mobile_users),
                                                            'contain'=>array('MobileUser'=>array('User'))));
            
            $this->set(compact('mobile_phone'));
            
            $data = $this->render('getmobile_users');
            
            echo $data;
            exit;
            
        }
        
        echo '<div class="col-sm-2"></div><div><b>No Mobile Users found in this sub division.</b></div>';
        exit;
        
    }
    
    
    public function edit( $id = false ){ 
        
        if( $this->request->is('post') or $this->request->is('put') ){
            
            $this->Complaint->id = $id;
            $this->loadModel('ComplaintHistory');
            $this->ComplaintHistory->pushComplaintHistory('Edit of Complaint', $id,  $this->request->data['Complaint'] );
            
            // Push notification based on the below condition
            if( $this->request->data['Complaint']['complaint_status_id'] == '1' ){ 
                $complaint = $this->Complaint->find('first',array('conditions'=>array('Complaint.id'=>$id)));
                if( $complaint['Complaint']['source'] == 'web' and $complaint['Complaint']['complaint_status_id'] == '5' ){
                    $this->loadModel('ComplaintNotification');
                    $this->ComplaintNotification->pushNotification( $complaint['Complaint']['id'], 'Status Changed to Pending' );
                }
            }
            
            $data_complaint = $this->request->data['Complaint'];
            
            $data_complaint = $this->Complaint->save( $data_complaint);

            if($data_complaint){
                $this->Complaint->Consumer->id = $this->request->data['Consumer']['id'];
                $this->Complaint->Consumer->save($this->request->data['Consumer']);
                $this->FlashMessage("0", "Changes have been saved successully");
                $this->redirect('/');
            }else{
                $this->FlashMessage("3");
            }
        }

        // Get complaint list.
        $colonies  = $this->Complaint->ColonyName->find('list',array('fields'=>array('id','colony_name'),'order'=>array('colony_name ASC')));;
        
        // These are the heading part of the page.
        $heading = 'Edit Complaint';
        $one_linner = 'Please check and make the changes.';
        
        // Get all parent categories to 1.
        $parent_categories = $this->Complaint->Category->children(1,true);

        $categories = array();
        
        // Generate all categories as list.
        foreach ($parent_categories as $each_parent){
            $categories[$each_parent['Category']['id']] =$each_parent['Category']['name'];
        }
        
        //Get all sudivisions list
        $subdivisions = $this->Complaint->Subdivision->find('list');
        
        // Get complaint status.
        $complaint_status = $this->Complaint->ComplaintStatus->find('list',array('fields'=>array('id','status')));
        
        // Get company priorities.
        $complaint_priorities = $this->Complaint->ComplaintPriority->find('list',array('fields'=>array('id','priority')));
        
        $path_to_cat = array();
        
        if( $id !== false ){
            $this->Complaint->id = $id;
            $this->request->data = $this->Complaint->read(null,$id);
            $parent = $this->Complaint->Category->getParentNode($this->request->data['Complaint']['category_id']);
            $parent_categories = $this->Complaint->Category->children($parent['Category']['id'],true);

            // Generate all categories as list.
            $categories= array();
            foreach ($parent_categories as $each_parent){
                $categories[$each_parent['Category']['id']] =$each_parent['Category']['name'];
            }
        }
        
        $this->set(compact('heading','one_linner','categories','subdivisions','complaint_status','complaint_priorities','path_to_cat','colonies'));
        
    }
    
    
    public function editmobile_users( $id = false , $sel_val = false){ 
        
        $this->layout = false;
        
        if( $id !== false ){
            
            // Get the users based in sundivision id.<br>
            $this->loadModel('MobileUser');
            $mobile_users = $this->MobileUser->find('list',array('conditions'=>array('MobileUser.subdivision_id'=>$id),
                                                                            'fields'=>array('id','id')));
            
            // Select mobile users from mobile user mobile phone.
            $this->loadModel('MobileUserMobilePhone');                  
            $mobile_phone = $this->MobileUserMobilePhone->find('all',array('conditions'=>array('MobileUserMobilePhone.mobile_user_id'=>$mobile_users),
                                                            'contain'=>array('MobileUser'=>array('User'))));
            
            $this->set(compact('mobile_phone','sel_val'));
            
            $data = $this->render('editmobile_users');

            echo $data;
            exit;
            
        }
        
        echo '<div class="col-sm-2"></div><div><b>No Mobile Users found in this sub division.</b></div>';
        exit;
        
    }
    public function generate_report(){
        $heading = 'Pdf Generate';
        $one_linner = 'Please fill the form to generate pdf.';

            // Get all parent categories to 1.
        $parent_categories = $this->Complaint->Category->children(1,true);

        $categories = array();
        
        // Generate all categories as list.
        foreach ($parent_categories as $each_parent){
            $categories[$each_parent['Category']['id']] =$each_parent['Category']['name'];
        }
        
        // $categories['0'] = 'Other';

        // print_r($categories);die();
        $status = $this->Complaint->ComplaintStatus->find('list',array('fields'=>array('id','status')));
        $subdivisions = $this->Complaint->Subdivision->find('list',array('fields'=>array('id','name')));
        // $categories =$this->Complaint->Category->find('list',array('fields'=>array('id','name')));
        $this->set(compact('heading','one_linner','status','subdivisions','categories'));
        // print_r($status);die();  
    }
    public function simple_report(){
        
        
        $heading = 'Generate Simple Report';
        $one_linner = 'Please fill the form to generate pdf.';

        $subdivisions = $this->Complaint->Subdivision->find('list',array('fields'=>array('id','name')));
        // $categories =$this->Complaint->Category->find('list',array('fields'=>array('id','name')));
    
        $this->set(compact('heading','one_linner','subdivisions'));
        
        
    }
    public function subdivision_report(){

        $heading = 'Generate Simple Report';
        $one_linner = 'Please fill the form to generate pdf.';

        $subdivisions = $this->Complaint->Subdivision->find('list',array('fields'=>array('id','name')));
        // $categories =$this->Complaint->Category->find('list',array('fields'=>array('id','name')));
    
        $this->set(compact('heading','one_linner','subdivisions'));
        
    }
    public function getchildencat_for_pdf( $id = false){
        
        $this->layout = false;
        
        if( $id !== false ){
            
            // Get all parent categories to 1.
            $parent_categories = $this->Complaint->Category->children($id,true);
            
            if(empty($parent_categories)){
                echo "fail";
                exit;
            } 
            
            $categories = array();
            
            // Generate all categories as list.
            foreach ($parent_categories as $each_parent){
                $categories[$each_parent['Category']['id']] =$each_parent['Category']['name'];
            }
            
            $this->set(compact('categories','id'));
            
            $return = $this->render('category_select_for_pdf');
            
            echo $return;
            exit;
            
        }
        
        echo "fail";
        exit;
        
    }
    public function getcenter( $id = false){
        $this->layout = false;
        
        if( $id !== false ){
            
             
            $this->loadModel('MobileUser');
            $centers = array();
            
            // Generate all categories as list.
            $centers = $this->MobileUser->find('list',array('fields'=>array('id','center_name'),'conditions'=>array('MobileUser.subdivision_id'=>$id)));
            
            $this->set(compact('centers','id'));
            
            $return = $this->render('centers_select');
            
            echo $return;
            exit;
            
        }
        
        echo "fail";
        exit;
        

    }
    public function getchildencat_for_cmc( $id = false){
        
        $this->layout = false;
        
        if( $id !== false ){
            
            // Get all parent categories to 1.
            $parent_categories = $this->Complaint->Category->children($id,true);
            
            if(empty($parent_categories)){
                echo "fail";
                exit;
            } 
            
            $categories = array();
            
            // Generate all categories as list.
            foreach ($parent_categories as $each_parent){
                $categories[$each_parent['Category']['id']] =$each_parent['Category']['name'];
            }
            
            $this->set(compact('categories','id'));
            
            $return = $this->render('category_select_for_cmc');
            
            echo $return;
            exit;
            
        }
        
        echo "fail";
        exit;
        
    }
    public function get_all_child_category($id){
        
        $parent_categories = $this->Complaint->Category->children($id,true);
                // print_r($parent_categories);die();
            if(!empty($parent_categories)){
                foreach ($parent_categories as $each_parent){
                
                array_push($this->categories_list,$each_parent['Category']['id']);
                $this->get_all_child_category($each_parent['Category']['id']);
                }
            }

        // return $categories_list;
    }

    public function view_pdf() 
    {
        if( $this->request->is('post') ){

            ini_set('max_execution_time', 300);

            $status = $this->Complaint->ComplaintStatus->find('list',array('fields'=>array('id','status')));
            $subdivisions = $this->Complaint->Subdivision->find('list',array('fields'=>array('id','name')));
            $categories =$this->Complaint->Category->find('list',array('fields'=>array('id','name')));

            App::import('Model','MobileUser');
            $MobileUser = new MobileUser();
            $centers =$MobileUser->find('list',array('fields'=>array('id','center_name')));
             // print_r($centers);die();
            $post_data = $this->request->data;

            // print_r($post_data);die();
            $categories_list = array( );
            $condition  = array( );


            
            if($post_data['date_range'] !="Select date range"){
                $ranges = explode("-", $post_data['date_range']);
                
                $start= trim($ranges[0]," ");
                $end = trim($ranges[1]," ");
                
                $info = date_parse($start);
                $start_date = $info["year"]."-".$info["month"]."-".$info["day"];
                $info1 = date_parse($end);
                $end_date = $info1["year"]."-".$info1["month"]."-".$info1["day"];
                $condition['and']= array('DATE(Complaint.created) >= ' => $start_date,
                              'DATE(Complaint.created) <= ' => $end_date
                             );
            } else{
                $condition['and']=  array( );
             
            }
            $cotegory_field = 'Complaint.category_id';
            if($post_data['category'] ==0 ){

            }elseif ($post_data['subcategory'] == 0) {
                
                $this->get_all_child_category($post_data['category']);
                $categories_list = $this->categories_list;

                array_push($categories_list,$post_data['category']);
                $condition['and'][$cotegory_field] = $categories_list;
            
            }else {
                // die("ff");
                $this->get_all_child_category($post_data['subcategory']);
                $categories_list = $this->categories_list;
                array_push($categories_list,$post_data['subcategory']);
                $condition['and'][$cotegory_field] = $categories_list;
                
                
            }
            // print_r($categories_ list);die();
            $status_field = 'Complaint.complaint_status_id';
            if($post_data['status'] ==0 ){
                // $status_field = $status_field." <>";
            }else{
                $condition['and'][$status_field] = $post_data['status'];
            }
            $subdivision_field = 'Complaint.subdivision_id';
            if($post_data['subdivision'] ==0 ){
                // $subdivision_field = $subdivision_field." <>";
            }else{
                $condition['and'][$subdivision_field] = $post_data['subdivision'];
            }
            $center_field= 'Complaint.mobile_user_mobile_phone_id';
            if(($post_data['center'] ==0 )){

            } else {
                $mobile_user_mobile_phones =$this->Complaint->MobileUserMobilePhone->find('list',array('fields'=>array('id'),'conditions' =>array('MobileUserMobilePhone.mobile_user_id' => $post_data['center'] )));
                $mobile_user_mobile_phones = array_values($mobile_user_mobile_phones);

                $condition['and'][$center_field] = $mobile_user_mobile_phones;
              

            }
           
            $mobile_user_mobile_phones_data = $this->Complaint->MobileUserMobilePhone->find('list',array('fields' => array('id','mobile_user_id')));
            

            $this->Complaint->Behaviors->load('Containable');
            $this->Complaint->contain(array('Consumer','ComplaintStatus','Category','Subdivision','User'));
            $complaints = $this->Complaint->find('all',array('conditions'=>$condition));
            $users = $this->Complaint->User->find('list',array('fields' => array('id','user_name'))); 
            // print_r($complaints);die();
            Configure::write('debug',0); // Otherwise we cannot use this method while developing 

            if (empty($complaints)) 
            { 
                $this->FlashMessage("3", "Sorry no result found");
                $this->redirect(array("action"=>"generate_report"));
            } 
            // print_r($post_data);die();
            
            $this->layout = 'pdf'; //this will use the pdf.ctp layout 
            $this->set(compact('mobile_user_mobile_phones_data','users','complaints','post_data','status','subdivisions','centers','categories'));

            // print_r($complaints);die();
        }
       
    }
    public function download_pdf(){
        if( $this->request->is('post') ){

           $post_data = $this->request->data;
           if($post_data['date_range'] !="Select date range"){
                $ranges = explode("-", $post_data['date_range']);
                
                $start= trim($ranges[0]," ");
                $end = trim($ranges[1]," ");
                
                $info = date_parse($start);
                $start_date = $info["year"]."-".$info["month"]."-".$info["day"];
                $info1 = date_parse($end);
                $end_date = $info1["year"]."-".$info1["month"]."-".$info1["day"];
                $condition['and']= array('DATE(Complaint.created) >= ' => $start_date,
                              'DATE(Complaint.created) <= ' => $end_date
                             );
            } else{
                $condition['and']=  array( );
             
            }
            $subdivision_field = 'Complaint.subdivision_id';
            if($post_data['subdivision'] ==0 ){
                // $subdivision_field = $subdivision_field." <>";
            }else{
                $condition['and'][$subdivision_field] = $post_data['subdivision'];
            }
            $center_field= 'Complaint.mobile_user_mobile_phone_id';
            if(($post_data['center'] ==0 )){

            } else {
                $mobile_user_mobile_phones =$this->Complaint->MobileUserMobilePhone->find('list',array('fields'=>array('id'),'conditions' =>array('MobileUserMobilePhone.mobile_user_id' => $post_data['center'] )));
                $mobile_user_mobile_phones = array_values($mobile_user_mobile_phones);

                $condition['and'][$center_field] = $mobile_user_mobile_phones;
              

            }
           
            // print_r($condition);die();
            $this->Complaint->Behaviors->load('Containable');
            $this->Complaint->contain(array('Consumer','ComplaintStatus','Category','Subdivision','User'));
            $complaints = $this->Complaint->find('all',array('conditions'=>$condition,'order'=>'Complaint.subdivision_id')); 
            Configure::write('debug',0); // Otherwise we cannot use this method while developing 

            // print_r($complaints);die();
            if (empty($complaints)) 
            { 
                $this->FlashMessage("3", "Sorry no result found");
                $this->redirect(array("action"=>"simple_report"));
            } 
            

            $this->layout = 'pdf'; //this will use the pdf.ctp layout 
            $this->set(compact('complaints','post_data'));


 
        }

    }
    public function subdivision_pdf(){
        if( $this->request->is('post') ){
                $start_date= " ";
                $end_date = " ";


           $post_data = $this->request->data;

           if($post_data['date_range'] !="Select date range"){
                $ranges = explode("-", $post_data['date_range']);
                
                $start= trim($ranges[0]," ");
                $end = trim($ranges[1]," ");
                
                $info = date_parse($start);
                $start_date = $info["year"]."-".$info["month"]."-".$info["day"];
                $info1 = date_parse($end);
                $end_date = $info1["year"]."-".$info1["month"]."-".$info1["day"];
                $condition['and']= array('DATE(Complaint.created) >= ' => $start_date,
                              'DATE(Complaint.created) <= ' => $end_date
                             );
            } else{
                $condition['and']=  array( );
             
            }

            $subdivision_field = 'Complaint.subdivision_id';
            if($post_data['subdivision'] ==0 ){
                $subdivisions = $this->Complaint->Subdivision->find('list',array('fields'=>array('id','name')));
            }else{
                
                $subdivisions = $this->Complaint->Subdivision->find('list',array('conditions'=>array('Subdivision.id' => $post_data['subdivision'] ),'fields'=>array('id','name'))); 
            }
            $center_field= 'Complaint.mobile_user_mobile_phone_id';
            if(($post_data['center'] ==0 )){

            } else {
                $mobile_user_mobile_phones =$this->Complaint->MobileUserMobilePhone->find('list',array('fields'=>array('id'),'conditions' =>array('MobileUserMobilePhone.mobile_user_id' => $post_data['center'] )));
                $mobile_user_mobile_phones = array_values($mobile_user_mobile_phones);

                $condition['and'][$center_field] = $mobile_user_mobile_phones;
              

            }

            
            $main = array( );
            foreach ($subdivisions as $key => $subdivision) {
                $condition['and'][$subdivision_field] = $key;
                $each['sub_id'] = $key;
                $each['sub_name'] = $subdivision;
                $condition['and']['ComplaintStatus.status <>'] = array('UnApproved','Ignored');
                $each['total'] = $this->Complaint->find('count',array('conditions'=> $condition));
                unset($condition['and']['ComplaintStatus.status <>']);
                $condition['and']['ComplaintStatus.status'] = 'Resolved';
                
                $each['rectfied'] =  $this->Complaint->find('count',array('conditions'=> $condition));
                $condition['and']['ComplaintStatus.status'] = array('Pending','Reopned');
                $each['pending'] =  $this->Complaint->find('count',array('conditions'=> $condition));
                unset($condition['and']['ComplaintStatus.status']);
                $main[$key] = $each;
            }
            Configure::write('debug',0); // Otherwise we cannot use this method while developing 

            // print_r($complaints);die();
            // if (empty($complaints)) 
            // { 
            //     $this->FlashMessage("3", "Sorry no result found");
            //     $this->redirect(array("action"=>"simple_report"));
            // } 
            

            $this->layout = 'pdf'; //this will use the pdf.ctp layout 
            $this->set(compact('main','post_data','start_date','end_date'));

            // die();
        }
    }
    
    
    public function getparentscat($id = false){
        
        if( $id !== false ){
            
            $path_to_cat = $this->Complaint->Category->getPath($id);
            $data['parent'] = $path_to_cat[1]['Category']['id'] ? $path_to_cat[1]['Category']['id'] : 0;
            
            // Unset the first two parents as they are already shown there.
            
            $list_array = array();

            if( count($path_to_cat) > 2 ){
                
                // Get all parent categories to 1.
                $parent_categories = $this->Complaint->Category->children($path_to_cat[2]['Category']['id'],true);
                
                if(empty($parent_categories)){
                    echo "fail";
                    exit;
                } 
                
                $categories = array();
                
                // Generate all categories as list.
                foreach ($parent_categories as $each_parent){
                    $categories[$each_parent['Category']['id']] =$each_parent['Category']['name'];
                }
                
                $this->set(compact('categories','id'));
                
                $return = $this->render('category_select');
                
            }
            else {

                
                            
            }
            
        }
        
    }
    
    /*
     * @WebService
     */
    public function get_pending_complaints(){
        $this->autoRender = false;
        $all_pending_complaints = $this->Complaint->find("all",array("conditions"=>array("Complaint.complaint_status_id"=>"1")));
        echo json_encode($all_pending_complaints);
    }


    public function view($id = null) {
        App::uses('ComplaintHistory', 'Model');
        App::uses('MobileUserMobilePhone', 'Model');
        // These are the heading part of the page.
        $heading = 'Complaints';
        $one_linner = 'List One Complaints.';
        
        //history
        $History = new ComplaintHistory();
        $complainthistories = $History->find('all',array('conditions' => array('ComplaintHistory.complaint_id' => $id)));
        
        //Used as Complaint reminders
        $this->loadModel('ComplaintNotification');
        $complaintnotification = $this->ComplaintNotification->find('all',array('conditions'=>array('ComplaintNotification.complaint_id' => $id,'ComplaintNotification.type_notification'=>'Reminder')));
        
        // print_r($histories);die();   
        // Get list of status.
        $status = $this->Complaint->ComplaintStatus->find('list',array('fields'=>array('id','status')));

        

        if (!$this->Complaint->exists($id)) {
            throw new NotFoundException(__('Invalid complaint'));
        }




        $this->Complaint->Behaviors->load('Containable');
        $this->Complaint->contain(array('Consumer','ComplaintStatus','Category','Subdivision','User','ComplaintPriority'));
        
        $options = array('conditions' => array('Complaint.' . $this->Complaint->primaryKey => $id));
        $complaint= $this->Complaint->find('first', $options);
        $interval  = array( );
        $datetime2_created = new DateTime($complaint['Complaint']['created']);
        $datetime2_modified = new DateTime($complaint['Complaint']['modified']);
        if($complaint['ComplaintStatus']['id'] == 2){

            $complainthistory_resolved = $History->find('first',array('conditions' => array('ComplaintHistory.complaint_id' => $id,'ComplaintHistory.current_status_id' => 2)));    

            $datetime1 = new DateTime($complainthistory_resolved['ComplaintHistory']['created']);
            
            $interval = $datetime1->diff($datetime2_created);
          
        }
        $MobileUserMobilePhone = new MobileUserMobilePhone();
        $mobile_user_mobile_phone = $MobileUserMobilePhone->find('first',array('conditions' => array('MobileUserMobilePhone.id' => $complaint['Complaint']['mobile_user_mobile_phone_id'])));
        
      
        $this->set(compact('complaint','heading','one_linner','status','complainthistories','complaintnotification','interval','mobile_user_mobile_phone','datetime2_created','datetime2_modified'));
        // print_r($complaint);

        // die($id);
    }
    

    public function status_edit( $id ){
        $this->Complaint->Behaviors->load('Containable');
        $this->Complaint->contain(array('Consumer','ComplaintStatus','Category','Subdivision','User','ComplaintPriority'));
        
        
        if( $this->request->is('post') or $this->request->is('put') ){
            
            $this->Complaint->id = $id;
            $this->loadModel('ComplaintHistory');
            $this->ComplaintHistory->pushComplaintHistory('Status Changed', $id, $this->request->data['Complaint'] );
            $data_complaint = $this->Complaint->save( $this->request->data);
            $this->FlashMessage("0", "Status changed succesfully");
            $this->redirect(array("action"=>"index"));
        }
        
        $this->layout = false;
        
        $this->Complaint->id = $id;
        $this->request->data = $this->Complaint->read(null,$id);
        $data = $this->request->data;
        // Get status to list.

        $complaint_status  = $this->Complaint->ComplaintStatus->find('list',array('fields'=>array('id','status'),'conditions' => array('ComplaintStatus.id' => array(1,2,4 ) )));
        
        
        
        $this->set(compact('complaint_status','data'));
        
    }
    
    
    public function subdivisioncomplaint(){ 
        
        $this_mobile_user = $this->Complaint->Subdivision->MobileUser->find('first',array('conditions'=>array('MobileUser.user_id'=>$this->Auth->user('id'))));
        
        $subdivison_id  = $this_mobile_user['MobileUser']['subdivision_id'];

        // These are the heading part of the page.
        $heading = 'Register Complaint';
        $one_linner = 'Please fill the form to register your complaint.';
        
        // Get all parent categories to 1.
        $parent_categories = $this->Complaint->Category->children(1,true);

        $categories = array();
        
        // Generate all categories as list.
        foreach ($parent_categories as $each_parent){
            $categories[$each_parent['Category']['id']] =$each_parent['Category']['name'];
        }
        
        // Get complaint list.
        $colonies  = $this->Complaint->ColonyName->find('list',array('fields'=>array('id','colony_name'),'order'=>array('colony_name ASC')));;
        
        $categories['0'] = 'Other';
        
        //Get all sudivisions list
        $subdivisions = $this->Complaint->Subdivision->find('list');
        
        
        // Get complaint status.
        $complaint_status = $this->Complaint->ComplaintStatus->find('list',array('fields'=>array('id','status')));
        
        // Get company priorities.
        $complaint_priorities = $this->Complaint->ComplaintPriority->find('list',array('fields'=>array('id','priority')));
        
        // Get the users based in sundivision id.<br>
        $this->loadModel('MobileUser');
        $mobile_users = $this->MobileUser->find('list',array('conditions'=>array('MobileUser.subdivision_id'=>$subdivison_id),
                                                                        'fields'=>array('id','id')));
        
        // Select mobile users from mobile user mobile phone.
        $this->loadModel('MobileUserMobilePhone');                  
        $mobile_phone = $this->MobileUserMobilePhone->find('all',array('conditions'=>array('MobileUserMobilePhone.mobile_user_id'=>$mobile_users),
                                                            'contain'=>array('MobileUser'=>array('User'))));
        
        $mobile_user_list = array();                                                    
        
        foreach ($mobile_phone as  $each_mobile_phone){ 
            
            $mobile_user_list[$each_mobile_phone['MobileUserMobilePhone']['id']] =  $each_mobile_phone['MobileUser']['center_name'].' - '.$each_mobile_phone['MobileUser']['User']['user_name']; 
        
        }
                                                            
        if( $this->request->is('post') ){

            $complaint = $this->request->data['Complaint'];
            $complaint['user_id'] = $this->Auth->user('id');
            
            // GEt asigned user id.
            $complaint['assigned_user'] =  $this->Complaint->MobileUserMobilePhone->getAssignedUser($complaint['mobile_user_mobile_phone_id']);
            
            $data_complaint = $this->Complaint->save($complaint);
            if($data_complaint){
                $consumer = $this->request->data['Consumer'];
                $consumer['bill_number'] =  $data_complaint['Complaint']['bill_no'];
                // CHeck bill number
                $this->Complaint->Consumer->id = $this->Complaint->Consumer->checkConsumerExisting($consumer['bill_number']);
                $this->Complaint->Consumer->save($consumer);
                $id = $this->Complaint->Consumer->id;
                $data_complaint = $this->request->data['Complaint'];
                $data_complaint['consumer_id'] = $id;
                $this->Complaint->save($data_complaint);
                $complaint_id = $this->Complaint->id;
                $this->loadModel('ComplaintNotification');
                $this->ComplaintNotification->pushNotification( $complaint_id, 'New Complaint', 'New' );
                $this->FlashMessage("0", "Your complaint has been registered successfully");
                $this->redirect(array('controller'=>'complaints',"action"=>"view/".$complaint_id));
            }else{
                
                $this->FlashMessage("3");
            }
        }
        
        $this->set(compact('heading','one_linner','categories','subdivisions','complaint_status','complaint_priorities','mobile_user_list','subdivison_id','colonies'));
        
    }
    
    
    
    
    public function webcomplaint(){ 
        
        $this->layout = 'striped';
        
        // sample subdivision.<br>
        $subdivison_id = 1;
        
        // These are the heading part of the page.
        $heading = 'Register Complaint';
        $one_linner = 'Please fill the form to register your complaint.';
        
        // Get all parent categories to 1.
        $parent_categories = $this->Complaint->Category->children(1,true);

        $categories = array();
        
        // Generate all categories as list.
        foreach ($parent_categories as $each_parent){
            $categories[$each_parent['Category']['id']] =$each_parent['Category']['name'];
        }
        
        $categories['0'] = 'Other';
        
        //Get all sudivisions list
        $subdivisions = $this->Complaint->Subdivision->find('list');
        
        
        // Get complaint status.
        $complaint_status = $this->Complaint->ComplaintStatus->find('list',array('fields'=>array('id','status')));
        
        // Get company priorities.
        $complaint_priorities = $this->Complaint->ComplaintPriority->find('list',array('fields'=>array('id','priority')));
        
        if( $this->request->is('post') ){

            $complaint = $this->request->data['Complaint'];
            $complaint['user_id'] = $this->Auth->user('id');
            
            $data_complaint = $this->Complaint->save($complaint);
            if($data_complaint){
                $this->Complaint->Consumer->save($this->request->data['Consumer']);
                $id = $this->Complaint->Consumer->id;
                $data_complaint = $this->request->data['Complaint'];
                $data_complaint['consumer_id'] = $id;
                $this->Complaint->save($data_complaint);
                $complaint_id = $this->Complaint->id;
                
                // Save notifications after saving the complaints.
                $notification_data = array();
                
                $notification_data['complaint_id'] = $id;
                $notification_data['notification_type'] = 'unapproved';
                $notification_data['pushed_by_user_id'] = '0';
                
                $this->Complaint->Notification->save($notification_data);
                
                $this->loadModel('ComplaintNotification');
                $this->ComplaintNotification->pushNotification( $complaint_id, 'New Complaint', 'New' );
       
                $this->redirect(array("action"=>"websuccess"));
            }else{
                $this->FlashMessage("3");
            }
        }
        
        $this->set(compact('heading','one_linner','categories','subdivisions','complaint_status','complaint_priorities','subdivison_id'));
        
    }
    
    public function websuccess(){
        
        $this->layout = 'striped';
        
        
    }
    
    
    public function check_bill( $bill_num ){
        $result['result'] = 'error';
        if( $bill_num!= '' ){
            $this->loadModel('ConsumerBill');
            $this->ConsumerBill->recursive = -1; 
            $data = $this->ConsumerBill->find('first',array('conditions'=>array('ConsumerBill.account'=>$bill_num)));
            if( $data ){
                $result['result'] = 'success';
                $result['data'] = $data['ConsumerBill'];
            }
        }
        
        echo json_encode($result);
        exit;
        
    }
    
      public function check_cnic(){
        
        $userId = $this->Auth->user('id');
        
        $params = $this->params['named'];
        
        $condition['OR'] = array();
        
        if($params['cnic'] != ''){
            $condition['OR']['Consumer.cnic'] = $params['cnic'] ;
        }
        
        if($params['mobile'] != ''){
            $condition['OR']['Consumer.mobile'] = $params['mobile'] ;
        }
        
        if($params['email'] != ''){
            $condition['OR']['Consumer.email'] = $params['email'] ;
        }
        
        if($params['billno'] != ''){
            $condition['OR']['Complaint.bill_no'] = $params['billno'] ;
        }

        // Get complaints with consumer _id
        
        $count =  $this->Complaint->find('count',array('conditions'=>$condition));
        
        if( $count  > 0 ){
            echo "success";
            exit;
        } else {
            echo "fail";
            exit;
        }
        
    }
    
    
    
    public function show_complaints( $cnic  ){
        
        $this->layout = false;
        
        $params = $this->params['named'];
        
        $condition['OR'] = array();
        
        if($params['cnic'] != ''){
            $condition['OR']['Consumer.cnic'] = $params['cnic'] ;
        }
        
        if($params['mobile'] != ''){
            $condition['OR']['Consumer.mobile'] = $params['mobile'] ;
        }
        
        if($params['email'] != ''){
            $condition['OR']['Consumer.email'] = $params['email'] ;
        }
        
        if($params['billno'] != ''){
            $condition['OR']['Complaint.bill_no'] = $params['billno'] ;
        }
        // Get complaints with consumer _id
        
        $complaints =  $this->Complaint->find('all',array('conditions'=>$condition));
        
        $this->set(compact('complaints'));
        
    }
    
    
    
    public function dashboard(){
        $heading = 'Dashboard';
        $one_linner = 'Dashboard shows the latest complaint details';
        $this->Complaint->Behaviors->load('Containable');
        $this->Complaint->contain(array('Consumer','ComplaintStatus','Category','Subdivision'));
        $total_complaints = $this->Complaint->find('count');
        $total_complaints_today = $this->Complaint->find('count',array('conditions'=> array('DATE(Complaint.created)' => date('Y-m-d') )));
        $total_complaints_resolved_today = $this->Complaint->find('count',array('conditions'=> array('DATE(Complaint.modified)' => date('Y-m-d'),'ComplaintStatus.status' => 'Resolved')));
        // echo $total_complaint_resolved_today;die();
        $complaints_web_unapproved = $this->Complaint->find('all',array('order' => array('Complaint.created DESC'),'limit' => 5,'conditions'=> array('Complaint.source' => 'web','ComplaintStatus.status' => 'UnApproved' )));
        $complaints_closed = $this->Complaint->find('all',array('order' => array('Complaint.created DESC'),'limit' => 5,'conditions'=> array('ComplaintStatus.status' => 'Closed By Subengineer' )));
        $complaints_today = $this->Complaint->find('all',array('order' => array('Complaint.created DESC'),'conditions'=> array('DATE(Complaint.created)' => date('Y-m-d') )));

        // print_r($complaints_today);die();
        $this->set(compact('heading','one_linner','total_complaints','total_complaints_today','total_complaints_resolved_today','complaints_web_unapproved','complaints_closed','complaints_today'));
    }
    public function web_unapproved(){
        $heading = 'Complaints';
        $one_linner = 'List All The Complaints With Source Web And Status UnApproved';
        $this->Complaint->Behaviors->load('Containable');
        $this->Complaint->contain(array('Consumer','ComplaintStatus','Category','Subdivision'));
        $complaints_web_unapproved = $this->Complaint->find('all',array('order' => array('Complaint.created DESC'),'conditions'=> array('Complaint.source' => 'web','ComplaintStatus.status' => 'UnApproved' )));
        $this->set(compact('heading','one_linner','complaints_web_unapproved'));
    }
    public function closed_subengineer(){
        $heading = 'Complaints';
        $one_linner = 'List All The Complaints With Status Closed By Subengineer';
        $this->Complaint->Behaviors->load('Containable');
        $this->Complaint->contain(array('Consumer','ComplaintStatus','Category','Subdivision'));
        $complaints_closed = $this->Complaint->find('all',array('order' => array('Complaint.created DESC'),'conditions'=> array('ComplaintStatus.status' => 'Closed By Subengineer' )));

        $this->set(compact('heading','one_linner','complaints_closed'));
    }
    
    public function complaint_reminder( $id ){
        
        $this->layout = false;
        
        if( $this->request->is('post') or $this->request->is('put') ){
            
            $this->loadModel('ComplaintNotification');
            
            if($this->ComplaintNotification->pushNotification( $id, $this->request->data['ComplaintNotification']['notification_comment'], 'Reminder' )){
            
                $this->FlashMessage("0", "Reminder saved successfully.");
                $this->redirect('/complaints/view/'.$id);

            }
            
        }
        
    }
    public function delete_complaint( $id ){
        $this->layout = false;
        if( $this->request->is('post') or $this->request->is('put') ){
            $this->loadModel('ComplaintNotification');
            $this->loadModel('ComplaintHistory');

            $this->Complaint->delete($id);
            $this->ComplaintNotification->deleteAll(array('ComplaintNotification.complaint_id' =>$id));
            $this->ComplaintHistory->deleteAll(array('ComplaintHistory.complaint_id' =>$id));
            $this->ComplaintNotification->pushNotification( $id, 'Please delete this complaint','Deleted' );

        

                $this->FlashMessage("0", "Complaint deleted successfully.");
                $this->redirect('/complaints');
        }

    }
    
    public function editweb( $id = false ){ 
        
        if( $this->request->is('post') or $this->request->is('put') ){
            
            $this->Complaint->id = $id;
            $this->loadModel('ComplaintHistory');
            $this->ComplaintHistory->pushComplaintHistory('Edit of Complaint', $id, $this->request->data['Complaint'] );
            
            $this->request->data['Complaint']['complaint_status_id'] = '1';
            
            
            $complaint = $this->request->data;
                $complaint['Complaint']['user_id'] = $this->Auth->user('id');;

                $data_complaint = $this->Complaint->save($complaint);
                // Push notification based on the below condition
            if( $this->request->data['Complaint']['complaint_status_id'] == '1' ){ 
                $complaint = $this->Complaint->find('first',array('conditions'=>array('Complaint.id'=>$id)));
                if( $complaint['Complaint']['source'] == 'web' ){
                    $this->loadModel('ComplaintNotification');
                    $this->ComplaintNotification->pushNotification( $complaint['Complaint']['id'], 'Registered Through Web','New' );
                }
            }
            //$data_complaint = $this->Complaint->save( $this->request->data);

            if($data_complaint){
                $this->Complaint->Consumer->id = $this->request->data['Consumer']['id'];
                $this->Complaint->Consumer->save($this->request->data['Consumer']);
                $this->FlashMessage("0", "Changes have been saved successully");
                $this->redirect('/');
            }else{
                $this->FlashMessage("3");
            }
        }
        
        // These are the heading part of the page.
        $heading = 'Edit Complaint';
        $one_linner = 'Please check and make the changes.';
        
        // Get all parent categories to 1.
        $parent_categories = $this->Complaint->Category->children(1,true);

        $categories = array();
        
        // Generate all categories as list.
        foreach ($parent_categories as $each_parent){
            $categories[$each_parent['Category']['id']] =$each_parent['Category']['name'];
        }
        
        //Get all sudivisions list
        $subdivisions = $this->Complaint->Subdivision->find('list');
        
        // Get complaint status.
        $complaint_status = $this->Complaint->ComplaintStatus->find('list',array('fields'=>array('id','status')));
        
        // Get company priorities.
        $complaint_priorities = $this->Complaint->ComplaintPriority->find('list',array('fields'=>array('id','priority')));
        
        $path_to_cat = array();
        
        if( $id !== false ){
            $this->Complaint->id = $id;
            $this->request->data = $this->Complaint->read(null,$id);
            if($this->request->data['Complaint']['subdivision_id'] != '0' or $this->request->data['Complaint']['source'] != 'web'){
                 $this->FlashMessage("3",'Invalid Request');
                 $this->redirect('/');
            }
            $parent = $this->Complaint->Category->getParentNode($this->request->data['Complaint']['category_id']);
            $parent_categories = $this->Complaint->Category->children($parent['Category']['id'],true);

            // Generate all categories as list.
            $categories= array();
            foreach ($parent_categories as $each_parent){
                $categories[$each_parent['Category']['id']] =$each_parent['Category']['name'];
            }
        }
        
        $this->set(compact('heading','one_linner','categories','subdivisions','complaint_status','complaint_priorities','path_to_cat'));
        
    }
    
    
    
    public function ignore( $id ){
        $this->Complaint->id = $id;
        $this->request->data = $this->Complaint->read(null,$id);
        if($this->request->data['Complaint']['subdivision_id'] != '0' or $this->request->data['Complaint']['source'] != 'web'){
             $this->FlashMessage("3",'Invalid Request');
             $this->redirect('/');
        }

        $this->request->data['Complaint']['complaint_status_id'] = '6';
        
        $this->loadModel('ComplaintNotification');
        $this->ComplaintNotification->pushNotification( $complaint['Complaint']['id'], 'Status Changed to Ignored' );
        
        $this->loadModel('ComplaintHistory');
        $this->ComplaintHistory->pushComplaintHistory('Change in Status', $id, $this->request->data['Complaint'] );
        
        $this->Complaint->save($this->request->data);
        
        $this->FlashMessage("0", "Status changed to Ignored");
        $this->redirect('/complaints/editweb/'.$id);

    }
    public function update_data(){
        $complaints = $this->Complaint->find('list',array('fields'=>array('id','mobile_user_mobile_phone_id')));
        $this->loadModel('MobileUserMobilePhone');
        $this->loadModel('MobileUser');
        foreach ($complaints as $id => $mobile_user_mobile_phone_id) {
                $mobile_user_id = $this->Complaint->MobileUserMobilePhone->find('list',array('conditions'=> array('MobileUserMobilePhone.id' => $mobile_user_mobile_phone_id ),'fields'=>array('id','mobile_user_id')));            
               
                if(!empty($mobile_user_id[$mobile_user_mobile_phone_id])){
                    App::uses('MobileUser', 'Model');
                    $MobileUser = new MobileUser();
                    $assigned_id = $MobileUser->find('list',array('conditions'=> array('MobileUser.id' => $mobile_user_id[$mobile_user_mobile_phone_id] ),'fields'=>array('id','user_id')));        
                    if(!empty($assigned_id[$mobile_user_id[$mobile_user_mobile_phone_id]])){
                        $user_id = $assigned_id[$mobile_user_id[$mobile_user_mobile_phone_id]];
                        $this->Complaint->updateAll(
                            array('Complaint.assigned_user' => $user_id),
                            array('Complaint.id =' => $id)
                        );
                            // print_r($assigned_id);
                    }         
                }     

        }

        die("Updated");
    }
    
    
    public function check_consumer_bill( $bill = '' ){
        $data['result'] = 'error';
        if( $bill != '' ){
            $id = $this->Complaint->Consumer->checkConsumerExisting($bill);
            if( $id ){
                $this->Complaint->Consumer->recursive = -1;
                $data = $this->Complaint->Consumer->find('first',array('conditions'=>array('bill_number'=>$bill)));
                $data['result'] = 'success';
            } else {
                $data['result'] = 'error';
            }
        }
        
        echo json_encode($data);
        exit;
        
    }


    
    
    
}