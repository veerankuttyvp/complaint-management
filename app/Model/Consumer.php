<?php
App::uses('AppModel', 'Model');
/**
 * Consumer Model
 *
 * @property Complaint $Complaint
 */
class Consumer extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'first_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'last_name' => array(
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
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Complaint' => array(
			'className' => 'Complaint',
			'foreignKey' => 'consumer_id',
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
	
	public function checkConsumerExisting($consumer_bill){
		if( isset($consumer_bill) and trim($consumer_bill) != '' ){
			$old_data = $this->find('first',array('conditions'=>array('bill_number'=>$consumer_bill)));
			if( $old_data ){
				$id =  $old_data['Consumer']['id'];
			} else {
				$id = false;
			}
			return $id;
		}
	}
	

}
