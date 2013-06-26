<?php
App::uses('StoryUpdate', 'Model');

/**
 * StoryUpdate Test Case
 *
 */
class StoryUpdateTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.story_update',
		'app.story',
		'app.story_type',
		'app.story_status',
		'app.created_by',
		'app.updated_by',
		'app.character_aspect',
		'app.story_character',
		'app.character'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->StoryUpdate = ClassRegistry::init('StoryUpdate');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->StoryUpdate);

		parent::tearDown();
	}

}
