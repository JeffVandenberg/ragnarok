<?php
App::uses('Story', 'Model');

/**
 * Story Test Case
 *
 */
class StoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.story',
		'app.story_type',
		'app.story_status',
		'app.created_by',
		'app.updated_by',
		'app.character_aspect',
		'app.story_character',
		'app.story_update'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Story = ClassRegistry::init('Story');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Story);

		parent::tearDown();
	}

}
