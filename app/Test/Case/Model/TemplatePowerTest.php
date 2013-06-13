<?php
App::uses('TemplatePower', 'Model');

/**
 * TemplatePower Test Case
 *
 */
class TemplatePowerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.template_power',
		'app.template',
		'app.created_by',
		'app.updated_by',
		'app.power'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TemplatePower = ClassRegistry::init('TemplatePower');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TemplatePower);

		parent::tearDown();
	}

}
