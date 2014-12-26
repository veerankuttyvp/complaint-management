<?php
App::uses('AppModel', 'Model');
/**
 * Complaint Model
 *
 * @property Consumer $Consumer
 * @property Category $Category
 * @property ComplaintStatus $ComplaintStatus
 * @property Subdivision $Subdivision
 * @property ComplaintPriority $ComplaintPriority
 * @property User $User
 * @property MobileUserMobilePhone $MobileUserMobilePhone
 * @property ComplaintHistory $ComplaintHistory
 * @property ComplaintNotification $ComplaintNotification
 * @property ComplaintUpdate $ComplaintUpdate
 */
class Complaint extends AppModel {
    public $actsAs = array('Containable');
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'consumer_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'category_id' => array(
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
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'complaint_address' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'subdivision_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'source' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'complaint_priority_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'mobile_user_mobile_phone_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'is_seen_by_subengineer' => array(
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
		'Consumer' => array(
			'className' => 'Consumer',
			'foreignKey' => 'consumer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
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
		'Subdivision' => array(
			'className' => 'Subdivision',
			'foreignKey' => 'subdivision_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ComplaintPriority' => array(
			'className' => 'ComplaintPriority',
			'foreignKey' => 'complaint_priority_id',
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
		'MobileUserMobilePhone' => array(
			'className' => 'MobileUserMobilePhone',
			'foreignKey' => 'mobile_user_mobile_phone_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ColonyName' => array(
			'className' => 'ColonyName',
			'foreignKey' => 'colony_name_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	/**
	 * Use has one for notification table.
	 * */
	
	 public $hasOne = array(
	   'Notification' => array(
			'className' => 'Notification',
			'foreignKey' => 'complaint_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		));
		

/**
 * hasMany associations
 *
 * @var array
 */
	/* $hasMany = array(
		'ComplaintHistory' => array(
			'className' => 'ComplaintHistory',
			'foreignKey' => 'complaint_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ComplaintNotification' => array(
			'className' => 'ComplaintNotification',
			'foreignKey' => 'complaint_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ComplaintUpdate' => array(
			'className' => 'ComplaintUpdate',
			'foreignKey' => 'complaint_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);*/
	
	
	function beforeSave($options = array()){
	
	 	if(!$this->id && !isset($this->data[$this->alias][$this->primaryKey])){
	 	//INSERT
	 	} else {
			App::import('Model','Complaint');
			$compModel = new Complaint();
			$complaint_pre = $compModel->find('first',array('conditions'=>array('Complaint.id'=>$this->id)));
			App::import('Model','ComplaintNotification');
			$compNotificationModel = new ComplaintNotification();
			if($complaint_pre['Complaint']['complaint_status_id'] == 3 && $this->data[$this->alias]['complaint_status_id'] == 4){
				
				$compNotificationModel->pushNotification( $this->id, 'Complaint has been reopened by operator. Please Check', 'Reopened' );
	 		
			}
			if($this->data[$this->alias]['complaint_status_id'] == 2){
				$compNotificationModel->pushNotification( $this->id, 'Complaint Has been Resolved', 'Resolved' );	
			}
	
	
	 		
		 //UPDATE
		}
		
	
	}

}
