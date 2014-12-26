<?php
App::uses('AppModel', 'Model');
/**
 * MobilePhone Model
 *
 */
class MobilePhone extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'mobile' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Mobile number should not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'imei' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'IMEI should not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'model' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Model should not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
