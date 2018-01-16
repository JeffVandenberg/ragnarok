<?php
namespace App\Model\Table;

use App\Model\Entity\CharacterPower;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CharacterPowers Model
 *
 * @property \App\Model\Table\CharactersTable|\Cake\ORM\Association\BelongsTo $Characters
 * @property \App\Model\Table\PowersTable|\Cake\ORM\Association\BelongsTo $Powers
 *
 * @method CharacterPower get($primaryKey, $options = [])
 * @method CharacterPower newEntity($data = null, array $options = [])
 * @method CharacterPower[] newEntities(array $data, array $options = [])
 * @method CharacterPower|bool save(EntityInterface $entity, $options = [])
 * @method CharacterPower patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method CharacterPower[] patchEntities($entities, array $data, array $options = [])
 * @method CharacterPower findOrCreate($search, callable $callback = null, $options = [])
 */
class CharacterPowersTable extends Table
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

        $this->setTable('character_powers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Characters', [
            'foreignKey' => 'character_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Powers', [
            'foreignKey' => 'power_id',
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
            ->requirePresence('refresh_cost', 'create')
            ->notEmpty('refresh_cost');

        $validator
            ->scalar('note')
            ->allowEmpty('note')
            ->maxLength('note', 45);

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
        $rules->add($rules->existsIn(['power_id'], 'Powers'));

        return $rules;
    }
}
