<?php
App::uses('Stunt', 'Model');

/**
 * Stunt Test Case
 *
 */
class StuntTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.stunt',
		'app.skill',
		'app.character_skill',
		'app.character',
		'app.game',
		'app.character_status',
		'app.user',
		'app.permission',
		'app.permissions_user',
		'app.template',
		'app.template_power',
		'app.power',
		'app.character_aspect',
		'app.aspect_type',
		'app.story',
		'app.story_type',
		'app.story_status',
		'app.story_character',
		'app.story_update',
		'app.character_power',
		'app.character_stunt'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Stunt = ClassRegistry::init('Stunt');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Stunt);

		parent::tearDown();
	}

}
