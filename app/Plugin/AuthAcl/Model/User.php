<?php
App::uses('AuthAclAppModel', 'AuthAcl.Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * User Model
 *
*/
class User extends AuthAclAppModel {

	public $validate = array(
			'user_email' => array(
					'required' => array(
							'rule' => array('notEmpty'),
							'message' => 'Please enter the value for User Email.'
					),
					'email' => array(
							'rule' => array('email'),
							'message' => 'Please provide a valid email address for User Email.'
					),
					'isEmailExisted' => array(
							'rule' => array('isEmailExisted'),
							'message' => 'User Email is existed.'
					)

			),
                        'user_mobile' => array(
					'required' => array(
							'rule' => array('notEmpty'),
							'message' => 'Please enter the value for User Mobile.'
					)

			),
			'user_password' => array(
					'required' => array(
							'rule' => array('notEmpty'),
							'message' => 'Please enter the value for Password.'
					)
			),
			'user_confirm_password' => array(
					'required' => array(
							'rule' => array('notEmpty'),
							'message' => 'Please enter the value for Confirm Password.'
					),
					'checkPassword' => array(
							'rule' => array('checkPassword'),
							'message' => 'Password and Confirmation password do not match.',
					)
			),
			'user_name' => array(
					'required' => array(
							'rule' => array('notEmpty'),
							'message' => 'Please enter the value for User Name'
					)
			)
	);

	public $reset_password_validate = array(
			'user_password' => array(
					'required' => array(
							'rule' => array('notEmpty'),
							'message' => 'Please enter the value for Password.'
					)
			),
			'user_confirm_password' => array(
					'required' => array(
							'rule' => array('notEmpty'),
							'message' => 'Please enter the value for Confirm Password.'
					),
					'checkPassword' => array(
							'rule' => array('checkPassword'),
							'message' => 'Password and Confirmation password do not match.',
					)
			)
	);

	public $signup_validate = array(
			'user_email' => array(
					'required' => array(
							'rule' => array('notEmpty'),
							'message' => 'Please enter the value for User Email.'
					),
					'email' => array(
							'rule' => array('email'),
							'message' => 'Please provide a valid email address for User Email.'
					),
					'isEmailExisted' => array(
							'rule' => array('isEmailExisted'),
							'message' => 'User Email is existed.'
					)

			),
			'user_password' => array(
					'required' => array(
							'rule' => array('notEmpty'),
							'message' => 'Please enter the value for Password.'
					)
			),
			'user_confirm_password' => array(
					'required' => array(
							'rule' => array('notEmpty'),
							'message' => 'Please enter the value for Confirm Password.'
					),
					'checkPassword' => array(
							'rule' => array('checkPassword'),
							'message' => 'Password and Confirmation password do not match.',
					)
			),
			'user_name' => array(
					'required' => array(
							'rule' => array('notEmpty'),
							'message' => 'Please enter the value for User Name'
					)
			),
			'recaptcha' => array(
					'required' => array(
							'rule' => array('recaptcha'),
							'message' => 'Please provide a valid ReCaptCha.'
					)
			)
	);

	public $hasAndBelongsToMany = array(
			'Group' => array(
					'className' => 'Group',
					'joinTable' => 'users_groups',
					'foreignKey' => 'user_id',
					'associationForeignKey' => 'group_id',
					'unique' => 'keepExisting',
					'conditions' => '',
					'fields' => '',
					'order' => '',
					'limit' => '',
					'offset' => '',
					'finderQuery' => '',
					'deleteQuery' => '',
					'insertQuery' => ''
			)
	);

	public $actsAs = array('Acl' => array('type' => 'requester'));

	public function parentNode() {
		return null;
	}

	public function isEmailExisted($check){
		$user = $this->find('first',array('conditions'=>array('`User`.`user_email`'=>$check['user_email'])));
		if (!empty($user)){
			return false;
		}else{
			return true;
		}
	}

	public function beforeSave($options = array()) {
		if (!empty($this->data['User']['user_password'])){
			$this->data['User']['user_password'] = AuthComponent::password($this->data['User']['user_password']);
		}
		return true;
	}

	public function checkPassword($check){
		return ($this->data['User']['user_password'] == $this->data['User']['user_confirm_password']);
	}

	public function recaptcha($check){
		App::uses('Setting', 'AuthAcl.Model');
		$Setting = new Setting();

		$general = $Setting->find('first',array('conditions' => array('setting_key' => sha1('general'))));
		if (!empty($general)){
			$general = unserialize($general['Setting']['setting_value']);
		}
		$flag = false;
		$privatekey = $general['Setting']['recaptcha_private_key'];
		$resp = null;
		$captchaerror = null;

		if (isset($_POST["recaptcha_response_field"]) && $_POST["recaptcha_response_field"]) {
			$resp = recaptcha_check_answer ($privatekey,
					$_SERVER["REMOTE_ADDR"],
					$_POST["recaptcha_challenge_field"],
					$_POST["recaptcha_response_field"]);

			if ($resp->is_valid) {
				$flag = true;
			}
		}

		return $flag;
	}

}
