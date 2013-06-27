<?php
/**
 * CharacterFixture
 *
 */
class CharacterFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'game_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'character_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'power_level' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 5),
		'max_fate' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4),
		'current_fate' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4),
		'character_status_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3, 'key' => 'index'),
		'created_by_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'updated_by_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'updated' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'character_status_idx' => array('column' => 'character_status_id', 'unique' => 0),
			'game_idx' => array('column' => 'game_id', 'unique' => 0),
			'created_by_idx' => array('column' => 'created_by_id', 'unique' => 0),
			'updated_by_idx' => array('column' => 'updated_by_id', 'unique' => 0)
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
			'game_id' => 1,
			'character_name' => 'Lorem ipsum dolor sit amet',
			'power_level' => 1,
			'max_fate' => 1,
			'current_fate' => 1,
			'character_status_id' => 1,
			'created_by_id' => 1,
			'created' => '2013-05-08 05:55:27',
			'updated_by_id' => 1,
			'updated' => '2013-05-08 05:55:27'
		),
	);

}
