<?php
App::uses('Subdivision', 'Model');

/**
 * Subdivision Test Case
 *
 */
class SubdivisionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.subdivision',
		'app.user',
		'app.group',
		'app.users_group',
		'app.complaint',
		'app.subengineer'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Subdivision = ClassRegistry::init('Subdivision');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Subdivision);

		parent::tearDown();
	}

}
