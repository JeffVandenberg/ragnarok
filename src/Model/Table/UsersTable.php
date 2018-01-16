<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\Database\Connection;
use Cake\Datasource\ConnectionManager;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\GroupsTable|\Cake\ORM\Association\BelongsToMany $Groups
 * @property \App\Model\Table\PermissionsTable|\Cake\ORM\Association\BelongsToMany $Permissions
 *
 * @method User get($primaryKey, $options = [])
 * @method User newEntity($data = null, array $options = [])
 * @method User[] newEntities(array $data, array $options = [])
 * @method User|bool save(EntityInterface $entity, $options = [])
 * @method User patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method User[] patchEntities($entities, array $data, array $options = [])
 * @method User findOrCreate($search, callable $callback = null, $options = [])
 */
class UsersTable extends Table
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

        $this->setTable('pinky_users');
        $this->setDisplayField('username');
        $this->setPrimaryKey('user_id');

        $this->belongsToMany('Groups', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'group_id',
            'joinTable' => 'groups_users'
        ]);
        $this->belongsToMany('Permissions', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'permission_id',
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
            ->scalar('user_name')
            ->maxLength('user_name', 45)
            ->requirePresence('user_name', 'create')
            ->notEmpty('user_name')
            ->add('user_name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 45)
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 45)
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator
            ->scalar('email_address')
            ->maxLength('email_address', 45)
            ->requirePresence('email_address', 'create')
            ->notEmpty('email_address')
            ->add('email_address', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('password')
            ->maxLength('password', 45)
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->scalar('last_login')
            ->maxLength('last_login', 45)
            ->requirePresence('last_login', 'create')
            ->notEmpty('last_login');

        $validator
            ->boolean('is_active')
            ->requirePresence('is_active', 'create')
            ->notEmpty('is_active');

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
        $rules->add($rules->isUnique(['email_address']));
        $rules->add($rules->isUnique(['user_name']));

        return $rules;
    }

    public function checkUserPermission($userId, $permissionIds)
    {
        if (!$userId || !$permissionIds) {
            return false;
        }
        if (!is_array($permissionIds)) {
            $permissionIds = array($permissionIds);
        }
        $permissionsPlaceholder = implode(',', array_fill(0, count($permissionIds), '?'));

        $sql = <<<SQL
SELECT 
  count(*) AS Count 
FROM 
  permissions_users 
WHERE
  user_id = ?
  AND permission_id IN ($permissionsPlaceholder);
SQL;
        $params = array_merge([$userId], $permissionIds);

        $connection = ConnectionManager::get('default');
        /* @var Connection $connection */

        $count = $connection->execute($sql, $params)->fetchAll('assoc');
        return $count[0]['Count'] > 0;
    }
}
