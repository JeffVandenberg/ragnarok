<?php
namespace App\Model\Table;

use App\Model\Entity\Permission;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Permissions Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsToMany $Users
 *
 * @method Permission get($primaryKey, $options = [])
 * @method Permission newEntity($data = null, array $options = [])
 * @method Permission[] newEntities(array $data, array $options = [])
 * @method Permission|bool save(EntityInterface $entity, $options = [])
 * @method Permission patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Permission[] patchEntities($entities, array $data, array $options = [])
 * @method Permission findOrCreate($search, callable $callback = null, $options = [])
 */
class PermissionsTable extends Table
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

        $this->setTable('permissions');
        $this->setDisplayField('permission_name');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Users', [
            'foreignKey' => 'permission_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'permissions_users'
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
            ->scalar('permission_name')
            ->maxLength('permission_name', 45)
            ->requirePresence('permission_name', 'create')
            ->notEmpty('permission_name');

        return $validator;
    }
}
