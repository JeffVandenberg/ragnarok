<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AspectTypes Model
 *
 * @property \App\Model\Table\CharacterAspectsTable|\Cake\ORM\Association\HasMany $CharacterAspects
 *
 * @method \App\Model\Entity\AspectType get($primaryKey, $options = [])
 * @method \App\Model\Entity\AspectType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AspectType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AspectType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AspectType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AspectType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AspectType findOrCreate($search, callable $callback = null, $options = [])
 */
class AspectTypesTable extends Table
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

        $this->setTable('aspect_types');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('CharacterAspects', [
            'foreignKey' => 'aspect_type_id'
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
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 45)
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
        $rules->add($rules->isUnique(['name']));

        return $rules;
    }
}
