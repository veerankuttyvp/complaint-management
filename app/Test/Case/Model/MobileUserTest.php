<?php
App::uses('MobileUser', 'Model');

/**
 * MobileUser Test Case
 *
 */
class MobileUserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.mobile_user',
		'app.user',
		'app.group',
		'app.users_group',
		'app.subdivision'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MobileUser = ClassRegistry::init('MobileUser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MobileUser);

		parent::tearDown();
	}

}
