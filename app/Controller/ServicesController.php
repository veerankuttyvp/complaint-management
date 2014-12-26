<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AdminController', 'Controller');

/**
 * Description of ServicesController
 *
 * @author chill
 */
class ServicesController extends AppController{
    //put your code here
    
    public $uses = array("Complaint","MobilePhone","MobileUserMobilePhone",'ComplaintNotification');
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->autoRender = false;
        $this->Auth->allow('GetPendingComplaintsOfImei');
        $this->Auth->allow('IsSeen');
        $this->Auth->allow('Get_notifications');
        $this->Auth->allow('GetDetailedComplaint');
        $this->Auth->allow('AcknowledgeNotification');
        
        $data = $this->request->data;
        /*if(!empty($data["imei"])){
            $imei = $data["imei"];
            App::import('Model','MobilePhone');
            $MobilePhone = new MobilePhone();
            $mobile_phone = $MobilePhone->find('first',array('conditions'=>array('MobilePhone.imei'=>$imei)));
            if (empty($mobile_phone)) {
                echo "Invalid Imei";
                die();
            }
        } else {
                echo 'Imei is sent';
                die();
        }*/        
                  
        
    }
    // To be Changed
    public function GetPendingComplaintsOfImei($imei = null){
        $result = array();
        $result['Status'] = 'Failed';
        //$imei = '1234567';
        $mobile_phone = $this->MobilePhone->find('first',array('conditions'=>array('MobilePhone.imei'=>$imei),'recursive'=> -1));
        if(!$mobile_phone){
            $result['Message']  = 'Your Mobile Phone is not registered. Please Contact Administrator';
            echo json_encode($result); return;
            
        }
        //new edit oct 25
        $mobile_users_mobile_phones = $this->MobileUserMobilePhone->find('all',array('conditions'=>array('MobileUserMobilePhone.mobile_phone_id'=>$mobile_phone['MobilePhone']['id'])));

        
        if(!$mobile_users_mobile_phones){
            $result['Message']  = 'Your Mobile Phone is registered But it is not Currently assigned. Please Contact Administrator';
            echo json_encode($result); return;
        }
        $mobile_users_mobile_phone_ids  = array();
        foreach ($mobile_users_mobile_phones as  $mobile) {
           array_push($mobile_users_mobile_phone_ids,$mobile['MobileUserMobilePhone']['id']);
        }
        
        $this->Complaint->Behaviors->load('Containable');
        $complaints = $this->Complaint->find('all',array('conditions'=>array('Complaint.complaint_status_id'=>'1','Complaint.mobile_user_mobile_phone_id'=>$mobile_users_mobile_phone_ids),
            'contain'=> array('Category.name','Consumer','ComplaintStatus','Subdivision.name')
            ));
        $result['Status'] = 'SUCCESS';
        $result['Complaint'] = $complaints;
        echo json_encode($result);
        return;
    }
    
    public function IsSeen(){
        if($this->request->is('POST')){
            $data = $this->request->data;
            $complaint_id = $data["complaint_id"];
            $is_seen_time = $data['date'];
            $complaint = $this->Complaint->find('first',array('conditions'=>array('Complaint.is_seen_by_subengineer'=>0,'Complaint.id'=>$complaint_id)));
            if($complaint){
                $this->Complaint->clear();
                $this->Complaint->id = $complaint_id;
                $this->Complaint->saveField('is_seen_by_subengineer', '1');
                $this->Complaint->saveField('is_seen_time', $is_seen_time);

                $result['Status'] = 'SUCCESS';
                $result['Message'] = 'Is Seen has been updated Successfully';
                echo json_encode($result);
            }else{
                $result['Status'] = 'FAILURE';
                $result['Message'] = 'Either Complaint is not found or it has already been seen';
                echo json_encode($result);
            }
        }
    }
    public function AcknowledgeNotification(){
        if($this->request->is('POST')){
            $data = $this->request->data;
            $notification_id = $data["complaint_notification_id"];
            $complaint = $this->ComplaintNotification->find('first',array('conditions'=>array('ComplaintNotification.id'=> $notification_id)));
            if($complaint){
                $this->ComplaintNotification->clear();
                $this->ComplaintNotification->id = $notification_id;
                $this->ComplaintNotification->saveField('is_pushed', '1');
                $result['Status'] = 'SUCCESS';
                $result['Message'] = 'Notification Has been received';
                echo json_encode($result);
            }else{
                $result['Status'] = 'FAILURE';
                $result['Message'] = 'Either Complaint is not found or it has already been Acknowledged';
                echo json_encode($result);
            }
        }
    }
    // To be Changed
    public function Get_notifications($imei = null){
        $result['Status'] = 'FAILURE';
        $mobile_phone = $this->MobilePhone->find('first',array('conditions'=>array('MobilePhone.imei'=>$imei),'recursive'=> -1));
        if(!$mobile_phone){
            $result['Message']  = 'Your Mobile Phone is not registered. Please Contact Administrator';
            echo json_encode($result); return;
            
        }
        // new edit 25th oct
        $mobile_users_mobile_phones = $this->MobileUserMobilePhone->find('all',array('conditions'=>array('MobileUserMobilePhone.mobile_phone_id'=>$mobile_phone['MobilePhone']['id'])));
        if(!$mobile_users_mobile_phones){
            $result['Message']  = 'Your Mobile Phone is registered But it is not Currently assigned. Please Contact Administrator';
            echo json_encode($result); return;
        }
        $mobile_users_mobile_phone_ids  = array();
        foreach ($mobile_users_mobile_phones as  $mobile) {
           array_push($mobile_users_mobile_phone_ids,$mobile['MobileUserMobilePhone']['id']);
        }
        
        $complaints = $this->Complaint->find('all',array('conditions'=>array('Complaint.mobile_user_mobile_phone_id'=>$mobile_users_mobile_phone_ids),'recursive'=> -1
            )); 
        $ids = array();
        foreach($complaints as $complaint){
            $ids[] = $complaint['Complaint']['id'];
        }
        $complaint_notifications = $this->ComplaintNotification->find('all',array('conditions'=>array('ComplaintNotification.complaint_id'=>$ids,'ComplaintNotification.is_pushed'=>'0'),'recursive'=>-1));
        $result['Status'] = 'SUCCESS';
        if($complaint_notifications){
            $result['ComplaintNotification'] = $complaint_notifications;
        }else{
            $result['ComplaintNotification'] = array();
        }
        echo json_encode($result);
        return;
        
    }
    public function GetDetailedComplaint($id = null){
        $result = array();
        $result['Status'] = 'Failed';
        $this->Complaint->Behaviors->load('Containable');
        $complaints = $this->Complaint->find('first',array('conditions'=>array('Complaint.id'=>$id),
            'contain'=> array('Category.name','Consumer','ComplaintStatus','Subdivision.name')
            ));
        $result['Status'] = 'SUCCESS';
        $result['Complaint'] = $complaints;
        echo json_encode($result);
        return;
    }
    
    public function Reply_Notifiication(){
        
    }
    /*public function AcknowledgeNotification($id = null){
        $result = array();
        $result['Status'] = array();
        
    }*/
}
