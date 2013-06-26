<?php
App::uses('AspectType', 'Model');

/**
 * AspectType Test Case
 *
 */
class AspectTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.aspect_type',
		'app.character_aspect'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->AspectType = ClassRegistry::init('AspectType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AspectType);

		parent::tearDown();
	}

}
