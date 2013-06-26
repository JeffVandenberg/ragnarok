<?php
App::uses('AppModel', 'Model');
/**
 * Permission Model
 *
 * @property User $User
 */
class Permission extends AppModel {

    public static $EditDatabase = 1;
    public static $Admin = 2;
    public static $ViewUsers = 3;
    public static $EditUsers = 4;
    public static $GameMaster = 5;

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'permission_name';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'permission_name' => array(
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
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'User' => array(
			'className' => 'User',
			'joinTable' => 'permissions_users',
			'foreignKey' => 'permission_id',
			'associationForeignKey' => 'user_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
