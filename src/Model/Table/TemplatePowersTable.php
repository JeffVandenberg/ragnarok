<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TemplatePowers Model
 *
 * @property \App\Model\Table\TemplatesTable|\Cake\ORM\Association\BelongsTo $Templates
 * @property \App\Model\Table\PowersTable|\Cake\ORM\Association\BelongsTo $Powers
 *
 * @method \App\Model\Entity\TemplatePower get($primaryKey, $options = [])
 * @method \App\Model\Entity\TemplatePower newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TemplatePower[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TemplatePower|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TemplatePower patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TemplatePower[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TemplatePower findOrCreate($search, callable $callback = null, $options = [])
 */
class TemplatePowersTable extends Table
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

        $this->setTable('template_powers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Templates', [
            'foreignKey' => 'template_id',
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
            ->requirePresence('power_cost', 'create')
            ->notEmpty('power_cost');

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
        $rules->add($rules->existsIn(['template_id'], 'Templates'));
        $rules->add($rules->existsIn(['power_id'], 'Powers'));

        return $rules;
    }
}
