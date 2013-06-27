<?php
/**
 * TemplatePowerFixture
 *
 */
class TemplatePowerFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'template_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'power_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'power_cost' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
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
			'template_id' => 1,
			'power_id' => 1,
			'power_cost' => 1
		),
	);

}
