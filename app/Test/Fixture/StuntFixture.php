<?php
/**
 * StuntFixture
 *
 */
class StuntFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'stunt_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'key' => 'unique', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'cost' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'skill_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'stunt_rules' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'is_official' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'is_approved' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'created_by_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'updated_by_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'updated' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'stunt_name_UNIQUE' => array('column' => 'stunt_name', 'unique' => 1)
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
			'stunt_name' => 'Lorem ipsum dolor sit amet',
			'cost' => 1,
			'skill_id' => 1,
			'stunt_rules' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'is_official' => 1,
			'is_approved' => 1,
			'created_by_id' => 1,
			'created' => '2013-05-25 18:06:05',
			'updated_by_id' => 1,
			'updated' => '2013-05-25 18:06:05'
		),
	);

}
