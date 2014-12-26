<?php
App::uses('AppModel', 'Model');
/**
 * ComplaintHistory Model
 *
 * @property Complaint $Complaint
 * @property User $User
 * @property ComplaintStatus $ComplaintStatus
 */
class ComplaintHistory extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'complaint_histories';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'complaint_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'action' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'complaint_status_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'previous_complaint_object' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Complaint' => array(
			'className' => 'Complaint',
			'foreignKey' => 'complaint_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ComplaintStatus' => array(
			'className' => 'ComplaintStatus',
			'foreignKey' => 'complaint_status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CurrentComplaintStatus' => array(
			'className' => 'ComplaintStatus',
			'foreignKey' => 'current_status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public function pushComplaintHistory( $action_type='', $complaint_id ='', $new_complaint = '' , $user_id =''){
		
		if( $complaint_id != '' ){
			
			App::import('Model','Complaint');
			$compModel = new Complaint();
			$complaint = $compModel->find('first',array('conditions'=>array('Complaint.id'=>$complaint_id)));

			$data['previous_complaint_object'] = serialize($complaint);
			$data['complaint_status_id'] = $complaint['Complaint']['complaint_status_id'];
			$data['current_status_id'] = $new_complaint['complaint_status_id'];
			
			if($user_id != ''){
				$data['user_id'] = $user_id;
			}else{
				$data['user_id'] = AuthComponent::user('id'); // Need to change whe the acl is up.
			}
			$data['complaint_id'] = $complaint_id;
			$data['action'] = $action_type;
		
			$this->save($data);
			
		}
		
		return false;
		
	}
	
	
}
