<?php
App::uses('AppModel', 'Model');
/**
 * Subdivision Model
 *
 * @property User $User
 * @property Complaint $Complaint
 * @property Subengineer $Subengineer
 */
class Subdivision extends AppModel {
    public $actsAs = array('Containable');
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'address' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),

				'message' => 'Address should not be empty',

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
				'message' => 'Please select assistant director of this subdivision',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'region' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Region should not be empty',
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'phone' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Phone should not be empty',
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
    public  $hasMany = array(
       'MobileUser' => array(
           "className" => 'MobileUser',
           "foreignKey" => 'subdivision_id'
       )  
    );
//	public $hasMany = array(
//		'Complaint' => array(
//			'className' => 'Complaint',
//			'foreignKey' => 'subdivision_id',
//			'dependent' => false,
//			'conditions' => '',
//			'fields' => '',
//			'order' => '',
//			'limit' => '',
//			'offset' => '',
//			'exclusive' => '',
//			'finderQuery' => '',
//			'counterQuery' => ''
//		),
//		'Subengineer' => array(
//			'className' => 'Subengineer',
//			'foreignKey' => 'subdivision_id',
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
        
        
        public function makeASDList($group,$user_id){
            $html = array(""=>"");
            foreach ($group['User'] as $user):
                $html[$user['id']] = $user["user_name"];
//                if($user['id'] == $user_id){
//                    $html[$user_id] = $user["user_name"];
//                }else{
//                    $html[$user['id']] = $user["user_name"];
//                }
            endforeach;
            return $html;
        }
}
