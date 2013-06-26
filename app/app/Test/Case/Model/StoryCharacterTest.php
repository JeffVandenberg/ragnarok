<?php
App::uses('StoryCharacter', 'Model');

/**
 * StoryCharacter Test Case
 *
 */
class StoryCharacterTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.story_character',
		'app.character',
		'app.story',
		'app.story_type',
		'app.story_status',
		'app.created_by',
		'app.updated_by',
		'app.character_aspect',
		'app.story_update'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->StoryCharacter = ClassRegistry::init('StoryCharacter');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->StoryCharacter);

		parent::tearDown();
	}

}
