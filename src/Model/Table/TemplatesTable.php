<?php
namespace App\Model\Table;

use App\Model\Entity\Template;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Templates Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $CreatedBies
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $UpdatedBies
 * @property \App\Model\Table\CharactersTable|\Cake\ORM\Association\HasMany $Characters
 * @property \App\Model\Table\TemplatePowersTable|\Cake\ORM\Association\HasMany $TemplatePowers
 *
 * @method Template get($primaryKey, $options = [])
 * @method Template newEntity($data = null, array $options = [])
 * @method Template[] newEntities(array $data, array $options = [])
 * @method Template|bool save(EntityInterface $entity, $options = [])
 * @method Template patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Template[] patchEntities($entities, array $data, array $options = [])
 * @method Template findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TemplatesTable extends Table
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

        $this->setTable('templates');
        $this->setDisplayField('template_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created' => 'new',
                    'updated' => 'always',
                ]
            ]
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
        $this->hasMany('Characters', [
            'foreignKey' => 'template_id'
        ]);
        $this->hasMany('TemplatePowers', [
            'foreignKey' => 'template_id'
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
            ->scalar('template_name')
            ->maxLength('template_name', 50)
            ->requirePresence('template_name', 'create')
            ->notEmpty('template_name');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->boolean('is_official')
            ->requirePresence('is_official', 'create')
            ->notEmpty('is_official');

        $validator
            ->boolean('is_approved')
            ->requirePresence('is_approved', 'create')
            ->notEmpty('is_approved');

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
        $rules->add($rules->existsIn(['created_by_id'], 'CreatedBy'));
        $rules->add($rules->existsIn(['updated_by_id'], 'UpdatedBy'));

        return $rules;
    }
}
