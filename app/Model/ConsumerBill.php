<?php
App::uses('AppModel', 'Model');
/**
 * Group Model
 *
 * @property User $User
 */
class ConsumerBill extends AppModel {


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $useTable = 'consumer_bills';
	

}
