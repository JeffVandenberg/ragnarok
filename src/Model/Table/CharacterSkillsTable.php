<?php
namespace App\Model\Table;

use App\Model\Entity\CharacterSkill;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CharacterSkills Model
 *
 * @property \App\Model\Table\CharactersTable|\Cake\ORM\Association\BelongsTo $Characters
 * @property \App\Model\Table\SkillsTable|\Cake\ORM\Association\BelongsTo $Skills
 *
 * @method CharacterSkill get($primaryKey, $options = [])
 * @method CharacterSkill newEntity($data = null, array $options = [])
 * @method CharacterSkill[] newEntities(array $data, array $options = [])
 * @method CharacterSkill|bool save(EntityInterface $entity, $options = [])
 * @method CharacterSkill patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method CharacterSkill[] patchEntities($entities, array $data, array $options = [])
 * @method CharacterSkill findOrCreate($search, callable $callback = null, $options = [])
 */
class CharacterSkillsTable extends Table
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

        $this->setTable('character_skills');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Characters', [
            'foreignKey' => 'character_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Skills', [
            'foreignKey' => 'skill_id',
            'joinType' => 'INNER'
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
            ->requirePresence('skill_level', 'create')
            ->notEmpty('skill_level');

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
        $rules->add($rules->existsIn(['character_id'], 'Characters'));
        $rules->add($rules->existsIn(['skill_id'], 'Skills'));

        return $rules;
    }
}
