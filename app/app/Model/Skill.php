<?php
App::uses('AppModel', 'Model');
/**
 * Skill Model
 *
 * @property Stunt $Stunt
 * @property CharacterSkill $CharacterSkill
 */
class Skill extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'skill_name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'skill_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'is_official' => array(
			'boolean' => array(
				'rule' => array('boolean'),
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
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Stunt' => array(
			'className' => 'Stunt',
			'foreignKey' => 'skill_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'CharacterSkill' => array(
			'className' => 'CharacterSkill',
			'foreignKey' => 'skill_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
