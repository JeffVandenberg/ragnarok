<?php
App::uses('PinkyUser', 'Model');

/**
 * PinkyUser Test Case
 *
 */
class PinkyUserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.pinky_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PinkyUser = ClassRegistry::init('PinkyUser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PinkyUser);

		parent::tearDown();
	}

}
