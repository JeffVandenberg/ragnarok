<?php
/**
 * Created by JetBrains PhpStorm.
 * User: JeffVandenberg
 * Date: 5/25/13
 * Time: 11:37 AM
 * To change this template use File | Settings | File Templates.
 */

App::uses('Component', 'Controller');

class RagnarokPermissionsComponent extends Component {
    public $uses = array('User');

    public function CheckPermission($userId, $permissionId)
    {
        App::uses('User', 'Model');
        $user = new User();
        return $user->CheckUserPermission($userId, $permissionId);
    }
}