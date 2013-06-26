<?php
App::uses('AppModel', 'Model');
/**
 * CharacterStunt Model
 *
 * @property Character $Character
 * @property Stunt $Stunt
 */
class CharacterStunt extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'character_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'stunt_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'note' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Character' => array(
			'className' => 'Character',
			'foreignKey' => 'character_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Stunt' => array(
			'className' => 'Stunt',
			'foreignKey' => 'stunt_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
