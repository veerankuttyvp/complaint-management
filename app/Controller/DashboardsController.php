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
class DashboardsController extends AdminController{
    
    public $uses = array("Complaint","Subdivision","MobileUser");
    public $helpers = array(
	'Form' => array('className' => 'Bs3Helpers.Bs3Form'),
        'Time',
        'AuthAcl.Acl'
    );
    public $categories_list  = array();

    
    public function cmc(){
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
    public function subdivisions(){
        $heading = 'Dashboard';
        $one_linner = 'Dashboard shows the latest complaint details of user\'s subdivision';
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
            // echo "$sub_id";die();
            // print_r($mobile_user);
            $this->Complaint->Behaviors->load('Containable');
            $this->Complaint->contain(array('Consumer','ComplaintStatus','Category','Subdivision'));
            $total_complaints = $this->Complaint->find('count',array('conditions'=> array('Complaint.subdivision_id' => $sub_id)));
            $total_complaints_today = $this->Complaint->find('count',array('conditions'=> array('DATE(Complaint.created)' => date('Y-m-d'),'Complaint.subdivision_id' => $sub_id )));
            $total_complaints_pending = $this->Complaint->find('count',array('conditions'=> array('Complaint.subdivision_id' => $sub_id,'ComplaintStatus.status' =>'Pending')));

            $complaints_today_list = $this->Complaint->find('all',array('conditions'=> array('DATE(Complaint.created)' => date('Y-m-d'),'Complaint.subdivision_id' => $sub_id ),'limit' =>5));
            $complaints_pending_list = $this->Complaint->find('all',array('conditions'=> array('Complaint.subdivision_id' => $sub_id,'ComplaintStatus.status' =>'Pending'),'limit' =>5));
            $complaints_list = $this->Complaint->find('all',array('conditions'=> array('Complaint.subdivision_id' => $sub_id),'limit' =>20 ));

            $this->set(compact('heading','one_linner','total_complaints','total_complaints_today','total_complaints_pending','complaints_today_list','complaints_pending_list','complaints_list'));       
            // print_r($complaints_list);
            // die("here");
        }else{

            $view = new View($this, false);
            $view->set(compact('heading', 'one_linner'));
            $html = $view->render('error');
                            // $return = $this->render('error');
            
            echo $html;
            exit;
        }
    }
    public function sub_today(){
        $heading = 'Complaints';
        $one_linner = 'List All The Complaints Registred Today For User\'s Subdivision';
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
            // echo "$sub_id";die();
            // print_r($mobile_user);
            $this->Complaint->Behaviors->load('Containable');
            $this->Complaint->contain(array('Consumer','ComplaintStatus','Category','Subdivision'));
            // echo $sub_id;die();
            $complaints_today_list = $this->Complaint->find('all',array('conditions'=> array('DATE(Complaint.created)' => date('Y-m-d'),'Complaint.subdivision_id' => $sub_id )));
            $this->set(compact('heading','one_linner','complaints_today_list'));       
        } else{
            $view = new View($this, false);
            $view->set(compact('heading', 'one_linner'));
            $html = $view->render('error');
                            // $return = $this->render('error');
            
            echo $html;
            exit;   
        }
    }
    public function sub_pending(){
        $heading = 'Complaints';
        $one_linner = 'List All The Complaints For User\'s Subdivision With Status Pending';
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
            // echo "$sub_id";die();
            // print_r($mobile_user);
            $this->Complaint->Behaviors->load('Containable');
            $this->Complaint->contain(array('Consumer','ComplaintStatus','Category','Subdivision'));
            // echo $sub_id;die();
            $complaints_pending_list = $this->Complaint->find('all',array('conditions'=> array('Complaint.subdivision_id' => $sub_id,'ComplaintStatus.status' =>'Pending')));
            $this->set(compact('heading','one_linner','complaints_pending_list'));       
        } else{
            $view = new View($this, false);
            $view->set(compact('heading', 'one_linner'));
            $html = $view->render('error');
                            // $return = $this->render('error');
            
            echo $html;
            exit;   
        }

    }
    public function sub_complaints(){
        $heading = 'Complaints';
        $one_linner = 'List All The Complaints For User\'s Subdivision';
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
            // echo "$sub_id";die();
            // print_r($mobile_user);
            $this->Complaint->Behaviors->load('Containable');
            $this->Complaint->contain(array('Consumer','ComplaintStatus','Category','Subdivision'));
            // echo $sub_id;die();
            $complaints_list = $this->Complaint->find('all',array('conditions'=> array('Complaint.subdivision_id' => $sub_id)));
            $this->set(compact('heading','one_linner','complaints_list'));       
        } else{
            $view = new View($this, false);
            $view->set(compact('heading', 'one_linner'));
            $html = $view->render('error');
                            // $return = $this->render('error');
            
            echo $html;
            exit;   
        }
    }
    public function widget(){
        $this->layout = 'dashboard';
        $pending_ids = Configure::read('pending_id_list');
        
        $heading = 'Complaints';
        $one_linner = 'List All The Complaints Details';
        $total_complaints = $this->Complaint->find('count');

        
        $total_complaints_pending = $this->Complaint->find('count',array('conditions'=> array('ComplaintStatus.id' => $pending_ids)));
        $total_complaints_solved = $this->Complaint->find('count',array('conditions'=> array('ComplaintStatus.status' => 'Resolved')));


        $total_complaints_today = $this->Complaint->find('count',array('conditions'=> array('DATE(Complaint.created)' => date('Y-m-d') )));
        $total_complaints_pending_today = $this->Complaint->find('count',array('conditions'=> array('Complaint.is_seen_by_subengineer' => 1,'DATE(Complaint.created)' => date('Y-m-d'))));
        $total_complaints_solved_today = $this->Complaint->find('count',array('conditions'=> array('ComplaintStatus.status' => 'Resolved','DATE(Complaint.modified)' => date('Y-m-d'))));

        $subdivisions = $this->Complaint->Subdivision->find('all',array());
        $main  = array( );
        $pi_graph = array( );
        // $nowUtc->format('Y-m-d h:i:s')
        foreach ($subdivisions as $key => $subdivision) {
            $status = 0;
            for($i=0;$i<6;$i++){
                if ($i==0){
                    $date = new DateTime();
                    $date2 = new DateTime('-5 days');
                } else{
                    $days_back = $i*5;
                    $days_back_2 = $days_back + 5;
                    $date =  new DateTime("-$days_back days");
                    $date2 =  new DateTime("-$days_back_2 days");

                }
                $count_comp = $this->Complaint->find('count',array('conditions'=> array('and'=>array( 

                    array('Complaint.created <= ' => $date->format('Y-m-d'),
                              'Complaint.created >= ' => $date2->format('Y-m-d')
                             ),

                    'Complaint.subdivision_id' =>  $subdivision['Subdivision']['id'],


                    )
                )));

                $complaints_list = $this->Complaint->find('all',array('conditions'=> array('Complaint.subdivision_id' =>  $subdivision['Subdivision']['id'],'ComplaintStatus.status' => 'Resolved')));


                $count_comp_resolved = 0;
                foreach ($complaints_list as $key => $complaints_list_single) {
                    # code...
                    App::uses('ComplaintHistory', 'Model');
                    $ComplaintHistory = new ComplaintHistory();
                    $count_comp_resolved_1 = $ComplaintHistory->find('count',array('conditions'=> array('and'=>array( 

                    array('ComplaintHistory.created <= ' => $date->format('Y-m-d'),
                              'ComplaintHistory.created >= ' => $date2->format('Y-m-d')
                             ),

                    'ComplaintHistory.complaint_status_id' =>  2,


                    )
                     )));
                    if($count_comp_resolved_1 > 0){
                        $count_comp_resolved++;
                    }

                }
                $main[$subdivision['Subdivision']['id']]['name'] = $subdivision['Subdivision']['name'];
                $main[$subdivision['Subdivision']['id']]['dates'][$date->format('Y_m_d')]['total_count'] =$count_comp;

                $main[$subdivision['Subdivision']['id']]['dates'][$date->format('Y_m_d')]['total_count_resolved'] =$count_comp_resolved;
                $main[$subdivision['Subdivision']['id']]['dates'][$date->format('Y_m_d')]['date'] =$date->format('Y_m_d');
            }
            // heat graph
            App::uses('MobileUser', 'Model');
            $MobileUser = new MobileUser();
            $mobile_users = $MobileUser->find('list',array('fields' => array('user_id','id'),'conditions' =>  array('MobileUser.subdivision_id' => $subdivision['Subdivision']['id'] )));
            foreach ($mobile_users as $user_id => $mobile_user_id) {
                for($i=0;$i<7;$i++){
                     if ($i==0){
                            $date10 = new DateTime();
                            
                        } else{
                            
                            
                            $date10 =  new DateTime("-$i days");
                            

                        }
                        // echo $date10->format('l');
                    
                    $total_complaints_pending_day= $this->Complaint->find('count',array('conditions'=> array('ComplaintStatus.id' => $pending_ids,'Complaint.assigned_user' => $user_id,'DATE(Complaint.created)' => $date10->format('Y-m-d'))));
                    if($total_complaints_pending_day >0){
                        $status =1;
                    }
                    $main[$subdivision['Subdivision']['id']]['heatchart'][$user_id][$date10->format('l')] = $total_complaints_pending_day;


                }
            }
            $main[$subdivision['Subdivision']['id']]['status'] = $status; 

                $resolved_count =  $this->Complaint->find('count',array('conditions'=> array('ComplaintStatus.status' => 'Resolved','Complaint.subdivision_id' =>$subdivision['Subdivision']['id'])));
                $total_complaints_count  = $this->Complaint->find('count',array('conditions'=> array('Complaint.subdivision_id' =>$subdivision['Subdivision']['id'])));

                if($total_complaints_count >0){
                $ratio =  $resolved_count/ $total_complaints_count;

                $pi_graph[$subdivision['Subdivision']['id']]['name']= $subdivision['Subdivision']['name'];
                $pi_graph[$subdivision['Subdivision']['id']]['ratio']= $ratio;
                $pi_graph[$subdivision['Subdivision']['id']]['total']= $total_complaints_count;
                $pi_graph[$subdivision['Subdivision']['id']]['resolved']= $resolved_count;
                }
            // print_r($mobile_users);die();

        }
        $users = $this->Complaint->User->find('list',array('fields' => array('id','user_name')));
        $parent_categories = $this->Complaint->Category->children(1,true);
        foreach ($parent_categories as  &$parent_category) {
            $arr = $this->get_all_child_category($parent_category['Category']['id']);
            $id_list = $this->categories_list;
            array_push($id_list,$parent_category['Category']['id']);

                // print_r($id_list);die();
            $this->categories_list = array();
            
            $category_count =  $this->Complaint->find('count',array('conditions'=> array('Complaint.category_id' =>$id_list)));
            $parent_category['Category']['total_complaints_count'] =$category_count ;           
        }

            $sample = array();
            foreach ($pi_graph as $key_new => $row_new)
            {
                $sample[$key_new] = $row_new['ratio'];
            }
            array_multisort($sample, SORT_DESC, $pi_graph);

        // print_r($parent_categories);die();
        // print_r($pi_graph);die();
        // print_r($main);
        // die();
        // echo $total_complaints_today;
        // die("ss");

        $this->set(compact('parent_categories','pi_graph','users','heading','one_linner','total_complaints','total_complaints_pending','total_complaints_solved','total_complaints_today','total_complaints_pending_today','total_complaints_solved_today','main'));
    }
    public function count_update(){
        $total_complaints_today = $this->Complaint->find('count',array('conditions'=> array('DATE(Complaint.created)' => date('Y-m-d') )));

        echo $total_complaints_today; die();        
    }
    public function report(){
        $heading = 'Reports';
        $one_linner = 'Show Complaint Reports';
        $this->layout = 'report_layout';
        $pending_ids = Configure::read('pending_id_list');
        $subdivisions_data  = array();
        $subdivisions = $this->Subdivision->find('list',array('fields'=>array('id','name')));
        $last_week  = array( );

        foreach ($subdivisions as $key => $subdivision_name) {
            $total_complaints_pending_sub = $this->Complaint->find('count',array('conditions'=> array('Subdivision.id' => $key,'ComplaintStatus.id' => $pending_ids)));
            $total_complaints_solved_sub = $this->Complaint->find('count',array('conditions'=> array('ComplaintStatus.status' => 'Resolved','Subdivision.id' => $key)));
            $total_complaints_sub = $this->Complaint->find('count',array('conditions'=> array('Subdivision.id' => $key)));

            $subdivisions_data[$key]['total_complaints_solved'] = $total_complaints_solved_sub;
            $subdivisions_data[$key]['total_complaints_pending'] = $total_complaints_pending_sub;
            $subdivisions_data[$key]['total_complaints'] = $total_complaints_sub ;
            $subdivisions_data[$key]['sub_name'] = $subdivision_name;
            
        }

        for($i=0;$i<7;$i++){
                     if ($i==0){
                            $date = new DateTime();
                            
                        } else{
                            
                            
                            $date =  new DateTime("-$i days");
                            

                        }
                        // echo $date10->format('l');
                    
                    $total_complaints_perday= $this->Complaint->find('count',array('conditions'=> array('DATE(Complaint.created)' => $date->format('Y-m-d'))));
                    $last_week[$date->format('Y_m_d')]['date'] = $date->format('d-M-Y');
                    $last_week[$date->format('Y_m_d')]['total_complaints'] = $total_complaints_perday;
                    // $last_week[$date->format('Y_m_d')]['date'] = $date->format('d-M-Y');
        }
        // print_r($last_week);die();

        $this->set(compact('heading','one_linner','subdivisions_data','last_week'));

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




}