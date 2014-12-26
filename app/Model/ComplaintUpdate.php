<?php
App::uses('AppModel', 'Model');
/**
 * ComplaintUpdate Model
 *
 * @property Complaint $Complaint
 * @property ComplaintUpdateStatus $ComplaintUpdateStatus
 */
class ComplaintUpdate extends AppModel {
    
    public $actsAs = array(
        'Upload.Upload' => array(
            'image_path' => array(
               "pathMethod" => "flat",
               "path" => '{ROOT}webroot{DS}img{DS}complaint_images{DS}'
            )
        )
    );
    
/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'complaint_updates';

/**
 * Validation rules
 *
 * @var array
 */
//	public $validate = array(
//		'complaint_id' => array(
//			'numeric' => array(
//				'rule' => array('numeric'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'image_path' => array(
//			'notEmpty' => array(
//				'rule' => array('notEmpty'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'comment' => array(
//			'notEmpty' => array(
//				'rule' => array('notEmpty'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'complaint_update_status_id' => array(
//			'numeric' => array(
//				'rule' => array('numeric'),
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
		'Complaint' => array(
			'className' => 'Complaint',
			'foreignKey' => 'complaint_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ComplaintUpdateStatus' => array(
			'className' => 'ComplaintUpdateStatus',
			'foreignKey' => 'complaint_update_status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
