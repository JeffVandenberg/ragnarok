<?php
App::uses('AppModel', 'Model');
/**
 * CharacterStatus Model
 *
 * @property Character $Character
 */
class CharacterStatus extends AppModel
{
    const NewCharacter = 1;
    const Approved = 2;
    const Retired = 3;
    const Archived = 4;

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';
    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'name' => array(
            'notblank' => array(
                'rule' => array('notblank'),
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
        'Character' => array(
            'className' => 'Character',
            'foreignKey' => 'character_status_id',
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
