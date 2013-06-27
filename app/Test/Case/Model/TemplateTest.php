<?php
App::uses('Template', 'Model');

/**
 * Template Test Case
 *
 */
class TemplateTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.template',
		'app.created_by',
		'app.updated_by',
		'app.character',
		'app.game',
		'app.character_status',
		'app.user',
		'app.permission',
		'app.permissions_user',
		'app.character_aspect',
		'app.aspect_type',
		'app.story',
		'app.story_type',
		'app.story_status',
		'app.story_character',
		'app.story_update',
		'app.character_power',
		'app.power',
		'app.character_skill',
		'app.skill',
		'app.stunt',
		'app.character_stunt',
		'app.template_power'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Template = ClassRegistry::init('Template');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Template);

		parent::tearDown();
	}

}
