<?php
/**
 * CharacterPowerFixture
 *
 */
class CharacterPowerFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'character_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'power_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'refresh_cost' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3),
		'note' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'charpow_character_idx' => array('column' => 'character_id', 'unique' => 0),
			'charpow_power_idx' => array('column' => 'power_id', 'unique' => 0)
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
			'character_id' => 1,
			'power_id' => 1,
			'refresh_cost' => 1,
			'note' => 'Lorem ipsum dolor sit amet'
		),
	);

}
