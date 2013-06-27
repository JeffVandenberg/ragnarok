<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property UserStatus $UserStatus
 * @property UserType $UserType
 * @property Game $Game
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'username';
    public $primaryKey = 'user_id';
    public $useTable = 'pinky_users';

    public function CheckUserPermission($userId, $permissionId)
    {
        if(!$userId || !$permissionId) {
            return false;
        }
        $count = $this->query("SELECT count(*) AS Count FROM  permissions_users where user_id = $userId AND permission_id = $permissionId;");
        return $count[0][0]['Count'] == 1;
    }

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'Permission' => array(
            'className' => 'Permission',
            'joinTable' => 'permissions_users',
            'foreignKey' => 'user_id',
            'associationForeignKey' => 'permission_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
        )
    );


}
