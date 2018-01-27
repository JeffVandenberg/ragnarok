<?php
namespace App\Model\Table;

use App\Model\Entity\Character;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Characters Model
 *
 * @property \App\Model\Table\GamesTable|\Cake\ORM\Association\BelongsTo $Games
 * @property \App\Model\Table\CharacterStatusesTable|\Cake\ORM\Association\BelongsTo $CharacterStatuses
 * @property \App\Model\Table\TemplatesTable|\Cake\ORM\Association\BelongsTo $Templates
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $CreatedBies
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $UpdatedBies
 * @property \App\Model\Table\SkillsTable|\Cake\ORM\Association\BelongsTo $PhysicalStressSkills
 * @property \App\Model\Table\SkillsTable|\Cake\ORM\Association\BelongsTo $MentalStressSkills
 * @property \App\Model\Table\SkillsTable|\Cake\ORM\Association\BelongsTo $SocialStressSkills
 * @property \App\Model\Table\SkillsTable|\Cake\ORM\Association\BelongsTo $HungerStressSkills
 * @property \App\Model\Table\BluebooksTable|\Cake\ORM\Association\HasMany $Bluebooks
 * @property \App\Model\Table\CharacterAspectsTable|\Cake\ORM\Association\HasMany $CharacterAspects
 * @property \App\Model\Table\CharacterGmNotesTable|\Cake\ORM\Association\HasMany $CharacterGmNotes
 * @property \App\Model\Table\CharacterPowersTable|\Cake\ORM\Association\HasMany $CharacterPowers
 * @property \App\Model\Table\CharacterSkillsTable|\Cake\ORM\Association\HasMany $CharacterSkills
 * @property \App\Model\Table\CharacterStuntsTable|\Cake\ORM\Association\HasMany $CharacterStunts
 * @property \App\Model\Table\DiceRollsTable|\Cake\ORM\Association\HasMany $DiceRolls
 * @property \App\Model\Table\RequestCharactersTable|\Cake\ORM\Association\HasMany $RequestCharacters
 * @property \App\Model\Table\RequestsTable|\Cake\ORM\Association\HasMany $Requests
 * @property \App\Model\Table\StoryCharactersTable|\Cake\ORM\Association\HasMany $StoryCharacters
 *
 * @method Character get($primaryKey, $options = [])
 * @method Character newEntity($data = null, array $options = [])
 * @method Character[] newEntities(array $data, array $options = [])
 * @method Character|bool save(EntityInterface $entity, $options = [])
 * @method Character patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Character[] patchEntities($entities, array $data, array $options = [])
 * @method Character findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CharactersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('characters');
        $this->setDisplayField('character_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created' => 'new',
                    'updated' => 'always',
                ]
            ]
        ]);

        $this->belongsTo('Games', [
            'foreignKey' => 'game_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CharacterStatuses', [
            'foreignKey' => 'character_status_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Templates', [
            'foreignKey' => 'template_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CreatedBy', [
            'foreignKey' => 'created_by_id',
            'joinType' => 'INNER',
            'className' => 'Users'
        ]);
        $this->belongsTo('UpdatedBy', [
            'foreignKey' => 'updated_by_id',
            'joinType' => 'INNER',
            'className' => 'Users'
        ]);
        $this->belongsTo('PhysicalStressSkill', [
            'foreignKey' => 'physical_stress_skill_id',
            'joinType' => 'INNER',
            'className' => 'Skills'
        ]);
        $this->belongsTo('MentalStressSkill', [
            'foreignKey' => 'mental_stress_skill_id',
            'joinType' => 'INNER',
            'className' => 'Skills'
        ]);
        $this->belongsTo('SocialStressSkill', [
            'foreignKey' => 'social_stress_skill_id',
            'joinType' => 'INNER',
            'className' => 'Skills'
        ]);
        $this->belongsTo('HungerStressSkill', [
            'foreignKey' => 'hunger_stress_skill_id',
            'joinType' => 'INNER',
            'className' => 'Skills'
        ]);
        $this->hasMany('Bluebooks', [
            'foreignKey' => 'character_id'
        ]);
        $this->hasMany('CharacterAspects', [
            'foreignKey' => 'character_id'
        ]);
        $this->hasMany('CharacterGmNotes', [
            'foreignKey' => 'character_id'
        ]);
        $this->hasMany('CharacterPowers', [
            'foreignKey' => 'character_id'
        ]);
        $this->hasMany('CharacterSkills', [
            'foreignKey' => 'character_id'
        ]);
        $this->hasMany('CharacterStunts', [
            'foreignKey' => 'character_id'
        ]);
        $this->hasMany('DiceRolls', [
            'foreignKey' => 'character_id'
        ]);
        $this->hasMany('RequestCharacters', [
            'foreignKey' => 'character_id'
        ]);
        $this->hasMany('Requests', [
            'foreignKey' => 'character_id'
        ]);
        $this->hasMany('StoryCharacters', [
            'foreignKey' => 'character_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('character_name')
            ->maxLength('character_name', 45)
            ->requirePresence('character_name', 'create')
            ->notEmpty('character_name');

        $validator
            ->requirePresence('power_level', 'create')
            ->notEmpty('power_level');

        $validator
            ->requirePresence('max_fate', 'create')
            ->notEmpty('max_fate');

        $validator
            ->requirePresence('skill_level', 'create')
            ->notEmpty('skill_level');

        $validator
            ->requirePresence('current_fate', 'create')
            ->notEmpty('current_fate');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['game_id'], 'Games'));
        $rules->add($rules->existsIn(['character_status_id'], 'CharacterStatuses'));
        $rules->add($rules->existsIn(['template_id'], 'Templates'));
        $rules->add($rules->existsIn(['created_by_id'], 'CreatedBy'));
        $rules->add($rules->existsIn(['updated_by_id'], 'UpdatedBy'));
        $rules->add($rules->existsIn(['physical_stress_skill_id'], 'PhysicalStressSkill'));
        $rules->add($rules->existsIn(['mental_stress_skill_id'], 'MentalStressSkill'));
        $rules->add($rules->existsIn(['social_stress_skill_id'], 'SocialStressSkill'));
        $rules->add($rules->existsIn(['hunger_stress_skill_id'], 'HungerStressSkill'));

        return $rules;
    }

    public function saveCharacter(Character $character)
    {
        // iterate through aspects, skills, powers, stunts, to remove those that are invalid
        foreach($character->character_skills as $i => $skill) {
            if(empty($skill->skill_id)) {
                unset($character->character_skills[$i]);
            }
            if($skill->skill_level < 1) {
                unset($character->character_skills[$i]);
            }
        }

        foreach($character->character_stunts as $i => $stunt) {
            if(empty($stunt->stunt_id)) {
                unset($character->character_stunts[$i]);
            }
        }

        foreach($character->character_powers as $i => $power) {
            if(empty($power->power_id)) {
                unset($character->character_powers[$i]);
            }
        }

        return $this->save($character, [
            'associated' => [
                'CharacterAspects',
                'CharacterSkills',
                'CharacterStunts',
                'CharacterPowers',
                'CharacterGmNotes',
            ]
        ]);
    }

    public function loadCharacter($id)
    {
        return $this->get($id, [
            'contain' => [
                'CharacterAspects' =>  [
                    'AspectTypes'
                ],
                'CreatedBy' => [
                    'fields' => [
                        'username',
                        'user_id'
                    ]
                ],
                'UpdatedBy' => [
                    'fields' => [
                        'username',
                        'user_id'
                    ]
                ],
                'CharacterStatuses',
                'Templates',
                'CharacterSkills' => [
                    'Skills'
                ],
                'CharacterStunts' => [
                    'Stunts' => [
                        'fields' => [
                            'stunt_name',
                            'is_official',
                            'is_approved'
                        ]
                    ]
                ],
                'CharacterPowers' => [
                    'Powers' => [
                        'fields' => [
                            'power_name',
                            'is_official',
                            'is_approved'
                        ]
                    ]
                ],
                'CharacterGmNotes' => [
                    'CreatedBy' => [
                        'fields' => [
                            'username'
                        ]
                    ]
                ],
                'PhysicalStressSkill',
                'MentalStressSkill',
                'SocialStressSkill',
                'HungerStressSkill'
            ]
        ]);
    }
}
