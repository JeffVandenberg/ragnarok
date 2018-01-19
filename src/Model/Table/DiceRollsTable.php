<?php
namespace App\Model\Table;

use App\Model\Entity\DiceRoll;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DiceRolls Model
 *
 * @property \App\Model\Table\CharactersTable|\Cake\ORM\Association\BelongsTo $Characters
 * @property \App\Model\Table\SkillsTable|\Cake\ORM\Association\BelongsTo $Skills
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $CreatedBies
 *
 * @method DiceRoll get($primaryKey, $options = [])
 * @method DiceRoll newEntity($data = null, array $options = [])
 * @method DiceRoll[] newEntities(array $data, array $options = [])
 * @method DiceRoll|bool save(EntityInterface $entity, $options = [])
 * @method DiceRoll patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method DiceRoll[] patchEntities($entities, array $data, array $options = [])
 * @method DiceRoll findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DiceRollsTable extends Table
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

        $this->setTable('dice_rolls');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Characters', [
            'foreignKey' => 'character_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('Skills', [
            'foreignKey' => 'skill_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CreatedBy', [
            'foreignKey' => 'created_by_id',
            'className' => 'Users'
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
            ->scalar('action_note')
            ->maxLength('action_note', 100)
            ->requirePresence('action_note', 'create')
            ->notEmpty('action_note');

        $validator
            ->requirePresence('roll_total', 'create')
            ->notEmpty('roll_total');

        $validator
            ->requirePresence('modifier', 'create')
            ->notEmpty('modifier');

        $validator
            ->requirePresence('skill_level', 'create')
            ->notEmpty('skill_level');

        $validator
            ->requirePresence('fate_spent', 'create')
            ->notEmpty('fate_spent');

        $validator
            ->scalar('aspects_tagged')
            ->allowEmpty('aspects_tagged');

        $validator
            ->boolean('is_official')
            ->requirePresence('is_official', 'create')
            ->notEmpty('is_official');

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
        $rules->add($rules->existsIn(['created_by_id'], 'CreatedBy'));

        return $rules;
    }
}
