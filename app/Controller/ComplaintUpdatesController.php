<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AdminController', 'Controller');

/**
 * CakePHP ComplaintUpdateController
 * @author lahore
 */
class ComplaintUpdatesController extends AdminController {

    public $uses = array("ComplaintUpdate","ComplaintUpdateStatus","Complaint");
    public $helpers = array('AuthAcl.Acl');
    public $name = "ComplaintUpdates";
    public function beforeFilter() {
        parent::beforeFilter();
        //$this->autoLayout = false;
        $this->Auth->allow('enter_update');
    }
    public function index() {
        $this->autoLayout = false;
        $this->Auth->allow('enter_update');
    }
    
    /*
     * @service
     */
    public function enter_update(){
        $this->autoLayout = false;
        $this->autoRender = false;
        
        if($this->request->is("post")){
            $data["ComplaintUpdate"] = $this->request->data;
            //die($data["ComplaintUpdate"]['lati']);
            if(isset($this->request->params["form"]["image_path"]["name"])){
            //$this->request->params["form"]["image_path"]["name"] = uniqid().$this->request->params["form"]["image_path"]["name"];
            }
            $data["ComplaintUpdate"]["image_path"] = $this->request->params["form"]["image_path"];
            $status_id = $this->ComplaintUpdateStatus->find("first",array("conditions"=>array("ComplaintUpdateStatus.status"=>$data["ComplaintUpdate"]["complaint_update_status"])));
            $data["ComplaintUpdate"]["complaint_update_status_id"] = $status_id["ComplaintUpdateStatus"]["id"];
            
            // new edit 25th oct
            if($data["ComplaintUpdate"]["complaint_update_status_id"] == 2 ){
                    $this->loadModel('ComplaintHistory','Compaint');
                    $id= $data["ComplaintUpdate"]["complaint_id"];
                    $new_complaint = $this->Complaint->find("first",array("conditions"=>array("Complaint.id"=>$id)));
                    $user_id = $new_complaint['MobileUserMobilePhone']['user_id'];
                    $new_complaint = $new_complaint['Complaint'];
                    $new_complaint["complaint_status_id"] = 3;
                    $lati = $data["ComplaintUpdate"]['lati'];
                    $longi = $data["ComplaintUpdate"]['longi'];
                    // print_r($lati);die();
                    $this->ComplaintHistory->pushComplaintHistory('Status Changed by Subengineer', $id, $new_complaint,$user_id );
                    if(!empty($data["ComplaintUpdate"]['lati']) && !empty($data["ComplaintUpdate"]['longi'])){
                        $this->Complaint->updateAll(array('Complaint.complaint_status_id'=>3,'Complaint.longi' => $longi,'Complaint.lat' => $lati), array('Complaint.id' => $id));    
                    }else{
                        $this->Complaint->updateAll(array('Complaint.complaint_status_id'=>3), array('Complaint.id' => $id));    
                    }    
                    

            }
            // new edit 25th oct
            try{
                if($this->ComplaintUpdate->save($data)){
                    echo "true";
                }else{
                    echo "false";
                }
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }
    }
    public function view($id = null){

        $heading = 'Complaint Status Update';
        $one_linner = 'Compaint status updates history.';
        $this->Complaint->Behaviors->load('Containable');
            $this->Complaint->contain(array('Consumer','ComplaintStatus','Category','Subdivision','User'));

        $complaint_details = $this->Complaint->find('first',  array('conditions' => array('Complaint.id' => $id ) )); 
        
        $complaintupdate_before= $this->ComplaintUpdate->find('first',  array('conditions' => array('ComplaintUpdate.complaint_id' => $id ,'ComplaintUpdateStatus.status' => 'Before') ));
        $complaintupdate_resolved= $this->ComplaintUpdate->find('first',  array('conditions' => array('ComplaintUpdate.complaint_id' => $id ,'ComplaintUpdateStatus.status' => 'Resolved') ));

        
        $options = array('conditions' => array('ComplaintUpdate.complaint_id' => $id,'NOT' => array('ComplaintUpdateStatus.status' => array("Before","Resolved"))));
        $complaintupdates= $this->ComplaintUpdate->find('all', $options);
        $this->set(compact('complaint_details','complaintupdate_before','complaintupdate_resolved','complaintupdates','heading','one_linner'));
        $this->set('prefix_complaint_images',$this->webroot.'img/complaint_images/');
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
            
            $this->redirect(array(
                
                'action' => 'view', 
                $id)
            );
        }
        
        $this->layout = false;
        
        $this->Complaint->id = $id;
        $this->request->data = $this->Complaint->read(null,$id);
        
        // Get status to list.
        $complaint_status  = $this->Complaint->ComplaintStatus->find('list',array('fields'=>array('id','status')));
        
        
        
        $this->set(compact('complaint_status'));
       
            // die("update");
            
            // $this->redirect(array("action"=>"view"));
        
    }

}