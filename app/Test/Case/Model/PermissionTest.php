<?php
App::uses('Permission', 'Model');

/**
 * Permission Test Case
 *
 */
class PermissionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.permission',
		'app.user',
		'app.permissions_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Permission = ClassRegistry::init('Permission');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Permission);

		parent::tearDown();
	}

}
