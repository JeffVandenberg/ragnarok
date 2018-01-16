<?php
namespace App\Model\Table;

use App\Model\Entity\CharacterStunt;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CharacterStunts Model
 *
 * @property \App\Model\Table\CharactersTable|\Cake\ORM\Association\BelongsTo $Characters
 * @property \App\Model\Table\StuntsTable|\Cake\ORM\Association\BelongsTo $Stunts
 *
 * @method CharacterStunt get($primaryKey, $options = [])
 * @method CharacterStunt newEntity($data = null, array $options = [])
 * @method CharacterStunt[] newEntities(array $data, array $options = [])
 * @method CharacterStunt|bool save(EntityInterface $entity, $options = [])
 * @method CharacterStunt patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method CharacterStunt[] patchEntities($entities, array $data, array $options = [])
 * @method CharacterStunt findOrCreate($search, callable $callback = null, $options = [])
 */
class CharacterStuntsTable extends Table
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

        $this->setTable('character_stunts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Characters', [
            'foreignKey' => 'character_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Stunts', [
            'foreignKey' => 'stunt_id',
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
        $rules->add($rules->existsIn(['stunt_id'], 'Stunts'));

        return $rules;
    }
}
