<?php
App::uses('AppModel', 'Model');
/**
 * CharacterAspect Model
 *
 * @property Character $Character
 * @property AspectType $AspectType
 * @property Story $Story
 * @property Character $AssocCharacter
 */
class CharacterAspect extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'aspect_text';

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
		'aspect_type_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'AspectType' => array(
			'className' => 'AspectType',
			'foreignKey' => 'aspect_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Story' => array(
			'className' => 'Story',
			'foreignKey' => 'story_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'AssocCharacter' => array(
			'className' => 'Character',
			'foreignKey' => 'assoc_character_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
