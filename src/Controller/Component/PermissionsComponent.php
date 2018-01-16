<?php
/**
 * Created by JetBrains PhpStorm.
 * User: JeffVandenberg
 * Date: 5/25/13
 * Time: 11:37 AM
 * To change this template use File | Settings | File Templates.
 */

namespace App\Controller\Component;


use App\Model\Entity\Permission;
use App\Model\Table\UsersTable;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

/**
 * @property Component\AuthComponent Auth
 */
class PermissionsComponent extends Component
{
    public $components = [
        'Auth'
    ];

    public function CheckSitePermission($userId, $SitePermissionId)
    {
        $userTable = TableRegistry::get('Users');
        /* @var UsersTable $userTable */
        return $userTable->checkUserPermission($userId, $SitePermissionId);
    }

    public function isGM()
    {
        $userdata = $this->Auth->user();
        return $this->CheckSitePermission($userdata['user_id'], array(
            Permission::$GameMaster,
            Permission::$Admin,
        ));
    }
}
