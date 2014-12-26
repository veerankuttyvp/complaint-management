<?php
App::uses('AppModel', 'Model');
/**
 * ComplaintNotification Model
 *
 * @property Complaint $Complaint
 * @property Operator $Operator
 * @property SubengineerMobilePhone $SubengineerMobilePhone
 */
class ComplaintNotification extends AppModel {

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
		'operator_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'subengineer_mobile_phone_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'notification_comment' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'is_pushed' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'is_responded' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
			'foreignKey' => 'operator_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MobileUserMobilePhone' => array(
			'className' => 'MobileUserMobilePhone',
			'foreignKey' => 'mobile_user_mobile_phone_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	
	public function pushNotification( $complaint_id = '',$message = '', $type = '' ){
		if( $complaint_id != '' ){
			
			App::import('Model','Complaint');
			$compModel = new Complaint();
			$complaint = $compModel->find('first',array('conditions'=>array('Complaint.id'=>$complaint_id)));
			
			$data['operator_id'] = AuthComponent::user('id');// Need to change whe the acl is up.
			$data['mobile_user_mobile_phone_id'] = $complaint['Complaint']['mobile_user_mobile_phone_id'];
			$data['complaint_id'] = $complaint_id;
			$data['notification_comment'] = $message;
			$data['type_notification'] = $type;
			$this->save($data);
			
			return true;
			
		}
		
		return false;
	}
	
	
}
