<?php
App::uses('StoryStatus', 'Model');

/**
 * StoryStatus Test Case
 *
 */
class StoryStatusTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.story_status',
		'app.story',
		'app.story_type',
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
		$this->StoryStatus = ClassRegistry::init('StoryStatus');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->StoryStatus);

		parent::tearDown();
	}

}
