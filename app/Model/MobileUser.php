<?php
App::uses('AppModel', 'Model');
/**
 * MobileUser Model
 *
 * @property User $User
 * @property Subdivision $Subdivision
 */
class MobileUser extends AppModel {
    public $actsAs = array('Containable');
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
		),
		'Subdivision' => array(
			'className' => 'Subdivision',
			'foreignKey' => 'subdivision_id',
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
	public $hasMany = array(
		'MobileUserMobilePhone' => array(
			'className' => 'MobileUserMobilePhone',
			'foreignKey' => 'mobile_user_id',
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
	);
        
        public function getUnAssignedMobileUsers(){
            $this->contain("User");
            /*$all_assigned_mobile_users = $this->find("all");
            $array1 = array();
            foreach ($all_assigned_mobile_users as $user):
                $array1[] = $user["User"];
            endforeach;
            $all_mobile_users = ClassRegistry::init("Group")->find("first",array("conditions"=>array("Group.name"=>'Subdivision')));
            $array2 = $all_mobile_users["User"];
            $unAssignedMobileUsers = array_diff_assoc($array2, $array1);*/
            //$UserModel = ClassRegistry::init('Group');
            //$UserModel->Behaviors->load('Containable');
            $users_subdivision = ClassRegistry::init("Group")->find("first",array("conditions"=>array("Group.name"=>'Subdivision')));
            
            $res = array();
            foreach ($users_subdivision['User'] as $user){
                $res[$user['id']] = $user['user_name'];
            }
            return $res;
        }
        
        
        
        

}
