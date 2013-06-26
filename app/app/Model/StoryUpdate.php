<?php
App::uses('AppModel', 'Model');
/**
 * StoryUpdate Model
 *
 * @property Story $Story
 * @property CreatedBy $CreatedBy
 * @property UpdatedBy $UpdatedBy
 */
class StoryUpdate extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'update_name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'story_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'update_name' => array(
			'minlength' => array(
				'rule' => array('minlength'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'description' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'created_by_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'updated_by_id' => array(
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
		'Story' => array(
			'className' => 'Story',
			'foreignKey' => 'story_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CreatedBy' => array(
			'className' => 'CreatedBy',
			'foreignKey' => 'created_by_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'UpdatedBy' => array(
			'className' => 'UpdatedBy',
			'foreignKey' => 'updated_by_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
