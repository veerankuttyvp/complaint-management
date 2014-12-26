<?php
App::uses('AppModel', 'Model');
/**
 * MobileUserMobilePhone Model
 *
 * @property MobileUser $MobileUser
 * @property MobilePhone $MobilePhone
 * @property Complaint $Complaint
 */
class MobileUserMobilePhone extends AppModel {
     public $actsAs = array('Containable');
/**
 * Validation rules
 *
 * @var array
 */
//	public $validate = array(
//		'mobile_user_id' => array(
//			'numeric' => array(
//				'rule' => array('numeric'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'mobile_phone_id' => array(
//			'numeric' => array(
//				'rule' => array('numeric'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'status' => array(
//			'numeric' => array(
//				'rule' => array('numeric'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'details' => array(
//			'notEmpty' => array(
//				'rule' => array('notEmpty'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'MobilePhone' => array(
			'className' => 'MobilePhone',
			'foreignKey' => 'mobile_phone_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MobileUser' => array(
			'className' => 'MobileUser',
			'foreignKey' => 'mobile_user_id',
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
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
//	public $hasMany = array(
//		'Complaint' => array(
//			'className' => 'Complaint',
//			'foreignKey' => 'mobile_user_mobile_phone_id',
//			'dependent' => false,
//			'conditions' => '',
//			'fields' => '',
//			'order' => '',
//			'limit' => '',
//			'offset' => '',
//			'exclusive' => '',
//			'finderQuery' => '',
//			'counterQuery' => ''
//		)
//	);
        
        public function getUnAssinedMobilePhones(){
            $this->contain("MobilePhone");
            $assignedPhones = $this->find("all");
            $array1 = array();
            foreach ($assignedPhones as $phone):
                $array1[] = $phone["MobilePhone"];
            endforeach;
            /*$allPhones = ClassRegistry::init("MobilePhone")->find("all");
            foreach ($allPhones as $phone):
                $array2[] = $phone["MobilePhone"];
            endforeach;
            $unAssignedMobilePhones = array_diff_assoc($array2, $array1);*/
            $unAssignedMobilePhones = $array1;
            $res = array(""=>"");
            foreach ($unAssignedMobilePhones as $phone){
                $res[$phone['id']] = $phone['mobile'];
            }
            return $res;
        }
        
        
        public function getAssignedUser($mobile_user_mobile_phone_id){
        	
        	$mobileuser_mobilephones = $this->find('first',array('conditions'=>array('MobileUserMobilePhone.id'=>$mobile_user_mobile_phone_id)));
        	$assigneduser  = $mobileuser_mobilephones['MobileUser']['user_id'];
        	
        	return $assigneduser;
        	
        }

}
