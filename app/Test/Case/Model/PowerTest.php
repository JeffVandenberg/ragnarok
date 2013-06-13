<?php
App::uses('Power', 'Model');

/**
 * Power Test Case
 *
 */
class PowerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.power',
		'app.created_by',
		'app.updated_by'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Power = ClassRegistry::init('Power');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Power);

		parent::tearDown();
	}

}
