<?php
App::uses('AppModel', 'Model');

/**
 * Character Model
 *
 * @property Game $Game
 * @property CharacterStatus $CharacterStatus
 * @property Template $Template
 * @property User $CreatedBy
 * @property User $UpdatedBy
 * @property CharacterAspect $CharacterAspect
 * @property CharacterPower $CharacterPower
 * @property CharacterSkill $CharacterSkill
 * @property CharacterStunt $CharacterStunt
 * @property StoryCharacter $StoryCharacter
 */
class Character extends AppModel
{
    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'character_name';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'game_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'character_name' => array(
            'minlength' => array(
                'rule' => array('minlength', 5),
                'message' => 'The Character Name is too short.',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'template_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            )
        ),
        'power_level' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'skill_level' => [
            'numeric'
        ],
        'max_fate' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'current_fate' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'character_status_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
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
        'Game' => array(
            'className' => 'Game',
            'foreignKey' => 'game_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'CharacterStatus' => array(
            'className' => 'CharacterStatus',
            'foreignKey' => 'character_status_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'CreatedBy' => array(
            'className' => 'User',
            'foreignKey' => 'created_by_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'UpdatedBy' => array(
            'className' => 'User',
            'foreignKey' => 'updated_by_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Template' => array(
            'className' => 'Template',
            'foreignKey' => 'template_id'
        ),
        'PhysicalStressSkill' => array(
            'className' => 'Skill',
            'foreignKey' => 'physical_stress_skill_id'
        ),
        'MentalStressSkill' => array(
            'className' => 'Skill',
            'foreignKey' => 'mental_stress_skill_id'
        ),
        'SocialStressSkill' => array(
            'className' => 'Skill',
            'foreignKey' => 'social_stress_skill_id'
        ),
        'HungerStressSkill' => array(
            'className' => 'Skill',
            'foreignKey' => 'hunger_stress_skill_id'
        ),
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'CharacterAspect' => array(
            'className' => 'CharacterAspect',
            'foreignKey' => 'character_id',
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
        'CharacterPower' => array(
            'className' => 'CharacterPower',
            'foreignKey' => 'character_id',
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
            'foreignKey' => 'character_id',
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
        'CharacterStunt' => array(
            'className' => 'CharacterStunt',
            'foreignKey' => 'character_id',
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
        'StoryCharacter' => array(
            'className' => 'StoryCharacter',
            'foreignKey' => 'character_id',
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
        'CharacterGmNote' => array(
            'className' => 'CharacterGmNote',
            'foreignKey' => 'character_id',
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
    );

    public function FindForUser($userId)
    {
        return $this->find('all', array(
            'conditions' => array(
                'Character.created_by_id' => $userId,
            ),
            'orderBy' => 'Character.character_name'
        ));
    }

    public function LoadCharacter($id)
    {
        $this->recursive = -1;
        $this->CharacterSkill->recursive = -1;
        $options = array(
            'conditions' => array(
                'Character.' . $this->primaryKey => $id
            ),
            'contain' => array(
                'CharacterAspect' => array(
                    'AspectType'
                ),
                'CreatedBy' => array(
                    'fields' => array(
                        'username',
                        'user_id'
                    )
                ),
                'UpdatedBy' => array(
                    'fields' => array(
                        'username',
                        'user_id'
                    )
                ),
                'CharacterStatus',
                'Template',
                'CharacterSkill' => array(
                    'Skill'
                ),
                'CharacterStunt' => array(
                    'Stunt' => array(
                        'fields' => array(
                            'stunt_name',
                            'is_official',
                            'is_approved'
                        )
                    )
                ),
                'CharacterPower' => array(
                    'Power' => array(
                        'fields' => array(
                            'power_name',
                            'is_official',
                            'is_approved'
                        )
                    )
                ),
                'CharacterGmNote' => array(
                    'CreatedBy' => array(
                        'fields' => array(
                            'username'
                        )
                    )
                ),
                'PhysicalStressSkill',
                'MentalStressSkill',
                'SocialStressSkill',
                'HungerStressSkill'
            )
        );
        $character = $this->find('first', $options);
        $this->CheckAspects($character);
        return $character;
    }

    public function LoadLimitedCharacter($id)
    {
        $this->recursive = -1;
        $this->CharacterSkill->recursive = -1;
        $options = array(
            'conditions' => array(
                'Character.' . $this->primaryKey => $id
            ),
            'contain' => false
        );
        $character = $this->find('first', $options);
        return $character;
    }

    private function CheckAspects(&$character)
    {
        if (count($character['CharacterAspect']) < 7) {
            $aspectTypeId = 1;
            for ($i = count($character['CharacterAspect']); $i < 7; $i++) {
                while ($this->HasAspectType($character['CharacterAspect'], $aspectTypeId)) {
                    $aspectTypeId++;
                }
                $aspect = $this->CharacterAspect->create();
                $aspect['aspect_type_id'] = $aspectTypeId;
                $character['CharacterAspect'][] = $aspect;
            }
        }
    }

    private function HasAspectType($CharacterAspect, $aspectTypeId)
    {
        $hasAspectType = false;
        if ($CharacterAspect) {
            foreach ($CharacterAspect as $aspect) {
                if ($aspect['aspect_type_id'] == $aspectTypeId) {
                    $hasAspectType = true;
                    continue;
                }
            }
        }
        return $hasAspectType;
    }

    public function SaveCharacter($character)
    {
        App::uses('Sanitize', 'Utility');

        if (isset($character['CharacterSkill'])) {
            foreach ($character['CharacterSkill'] as $row => $item) {
                if (($item['skill_id'] == '0') || ($item['skill_id'] == '')) {
                    unset($character['CharacterSkill'][$row]);
                }
            }
            if (count($character['CharacterSkill']) == 0) {
                unset($character['CharacterSkill']);
            }
        }

        if (isset($character['CharacterStunt'])) {
            foreach ($character['CharacterStunt'] as $row => $item) {
                if (($item['stunt_id'] == '0') || ($item['stunt_id'] == '')) {
                    unset($character['CharacterStunt'][$row]);
                }
            }
            if (count($character['CharacterStunt']) == 0) {
                unset($character['CharacterStunt']);
            }
        }

        if (isset($character['CharacterPower'])) {
            foreach ($character['CharacterPower'] as $row => $item) {
                if (($item['power_id'] == '0') || ($item['power_id'] == '')) {
                    unset($character['CharacterPower'][$row]);
                }
            }
            if (count($character['CharacterPower']) == 0) {
                unset($character['CharacterPower']);
            }
        }

        $datasource = $this->getDataSource();
        $datasource->begin();
        $this->CharacterSkill->deleteAll(array(
            'CharacterSkill.character_id' => $character['Character']['id']
        ));
        $this->CharacterStunt->deleteAll(array(
            'CharacterStunt.character_id' => $character['Character']['id']
        ));
        $this->CharacterPower->deleteAll(array(
            'CharacterPower.character_id' => $character['Character']['id']
        ));
        $success = $this->saveAssociated($character);
        if ($success) {
            $datasource->commit();
        } else {
            $datasource->rollback();
        }
        return $success;
    }

    public function SaveLimitedCharacter($character)
    {
        App::uses('Sanitize', 'Utility');

        $success = $this->save($character);
        return $success;
    }
}
