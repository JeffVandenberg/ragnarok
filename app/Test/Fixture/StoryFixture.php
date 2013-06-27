<?php
/**
 * StoryFixture
 *
 */
class StoryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'story_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 60, 'key' => 'unique', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'story_description' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'power_level' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 5),
		'story_type_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3),
		'story_status_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3, 'key' => 'index'),
		'completed_on' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'created_by_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'updated_by_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'updated' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'story_name_UNIQUE' => array('column' => 'story_name', 'unique' => 1),
			'story_status_idx' => array('column' => 'story_status_id', 'unique' => 0),
			'story_created_by_idx' => array('column' => 'created_by_id', 'unique' => 0),
			'story_updated_by_idx' => array('column' => 'updated_by_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'story_name' => 'Lorem ipsum dolor sit amet',
			'story_description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'power_level' => 1,
			'story_type_id' => 1,
			'story_status_id' => 1,
			'completed_on' => '2013-05-08 05:09:24',
			'created_by_id' => 1,
			'created' => '2013-05-08 05:09:24',
			'updated_by_id' => 1,
			'updated' => '2013-05-08 05:09:24'
		),
	);

}
