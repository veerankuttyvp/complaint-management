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
class ComplaintHistoriesController extends AdminController{
    
    public $uses = array("ComplaintHistory","ComplaintStatus");
    public $helpers = array(
	'Form' => array('className' => 'Bs3Helpers.Bs3Form'),
        'Time',
        'AuthAcl.Acl'
    );

    
    public function index(){
    	
    	
    }
    public function view($id = null){


        $heading = 'Complaint History';
        $one_linner = 'History Of One Complaints.';
        
        // Get list of status.
 

        // if (!$this->ComplaintHistory->exists($id)) {
        //     throw new NotFoundException(__('Invalid complaint'));
        // }

     // die('died here');


        
        $options = array('conditions' => array('ComplaintHistory.complaint_id' => $id));
        $complainthistories= $this->ComplaintHistory->find('all', $options);
        $this->set(compact('complainthistories','heading','one_linner'));
        // print_r($complainthistories);

        // die($id);

    }
}