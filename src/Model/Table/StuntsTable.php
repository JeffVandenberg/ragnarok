<?php
namespace App\Model\Table;

use App\Model\Entity\Stunt;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Stunts Model
 *
 * @property \App\Model\Table\SkillsTable|\Cake\ORM\Association\BelongsTo $Skills
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $CreatedBies
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $UpdatedBies
 * @property \App\Model\Table\CharacterStuntsTable|\Cake\ORM\Association\HasMany $CharacterStunts
 *
 * @method Stunt get($primaryKey, $options = [])
 * @method Stunt newEntity($data = null, array $options = [])
 * @method Stunt[] newEntities(array $data, array $options = [])
 * @method Stunt|bool save(EntityInterface $entity, $options = [])
 * @method Stunt patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Stunt[] patchEntities($entities, array $data, array $options = [])
 * @method Stunt findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StuntsTable extends Table
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

        $this->setTable('stunts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created' => 'new',
                    'updated' => 'always',
                ]
            ]
        ]);

        $this->belongsTo('Skills', [
            'foreignKey' => 'skill_id',
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
        $this->hasMany('CharacterStunts', [
            'foreignKey' => 'stunt_id'
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
            ->scalar('stunt_name')
            ->maxLength('stunt_name', 45)
            ->requirePresence('stunt_name', 'create')
            ->notEmpty('stunt_name');

        $validator
            ->requirePresence('cost', 'create')
            ->notEmpty('cost');

        $validator
            ->scalar('stunt_rules')
            ->requirePresence('stunt_rules', 'create')
            ->notEmpty('stunt_rules');

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
        $rules->add($rules->existsIn(['skill_id'], 'Skills'));
        $rules->add($rules->existsIn(['created_by_id'], 'CreatedBy'));
        $rules->add($rules->existsIn(['updated_by_id'], 'UpdatedBy'));

        return $rules;
    }
}
