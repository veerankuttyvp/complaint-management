<?php
App::uses('AppModel', 'Model');
/**
 * ComplaintNotification Model
 *
 * @property Complaint $Complaint
 * @property Operator $Operator
 * @property SubengineerMobilePhone $SubengineerMobilePhone
 */
class ColonyName extends AppModel {

public $hasMany = array(
	   'Complaints' => array(
			'className' => 'Complaints',
			'foreignKey' => 'company_name_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		));
	
	
}
