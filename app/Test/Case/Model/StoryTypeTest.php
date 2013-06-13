<?php
App::uses('StoryType', 'Model');

/**
 * StoryType Test Case
 *
 */
class StoryTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.story_type',
		'app.story',
		'app.story_status',
		'app.created_by',
		'app.updated_by',
		'app.character_aspect',
		'app.story_character',
		'app.character',
		'app.story_update'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->StoryType = ClassRegistry::init('StoryType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->StoryType);

		parent::tearDown();
	}

}
