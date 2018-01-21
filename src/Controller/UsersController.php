<?php

namespace App\Controller;

use App\Controller\Component\PermissionsComponent;
use App\Model\Entity\Permission;
use App\Model\Table\UsersTable;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property PermissionsComponent $Permissions
 * @property UsersTable $Users
 */
class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->deny();
    }

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $query = $this->Users->find('all')
            ->where([
                'Users.user_type !=' => 2
            ]);
        $filter = strtolower($this->request->getQuery('filter'));
        if($filter) {
            $query->andWhere([
                'OR' => [
                    ['Users.username_clean like' => $filter . '%'],
                    ['Users.user_email like' => $filter . '%'],
                ]
            ]);
        }
        $this->set('users', $this->Paginator->paginate($query, [
            'order' => [
                'Users.username_clean'
            ]
        ]));
        $actions = array();
        if ($this->Permissions->CheckSitePermission($this->Auth->user('user_id'), Permission::$EditUsers)) {
            $actions['edit'] = true;
        }
        $this->set(compact('actions', 'filter'));
    }

    /**
     * view method
     *
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        $options = array(
            'contain' => array(
                'Permissions' => array(
                    'sort' => array(
                        'Permissions.permission_name'
                    )
                )
            )
        );
        $this->set('user', $this->Users->get($id, $options));
        $actions = [];
        if ($this->Permissions->CheckSitePermission($this->Auth->user('user_id'), Permission::$EditUsers)) {
            $actions['edit'] = true;
        }
        $this->set(compact('actions'));
    }

    public function login()
    {
    }

    public function editPermissions($id = null)
    {
        $options = [
            'contain' => [
                'Permissions'
            ]
        ];
        $user = $this->Users->get($id, $options);

        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->request->getData('action') == 'Cancel') {
                $this->redirect(array('action' => 'view', $id));
            } else {
                $user = $this->Users->patchEntity($user, $this->request->getData());
                if ($this->Users->save($user, [
                    'associated' => [
                        'Permissions'
                    ]
                ])) {
                    $this->Flash->set(__('The user\'s permissions have been updated.'));
                    $this->redirect(['action' => 'view', $id]);
                } else {
                    $this->Flash->set(__('The user could not be saved. Please, try again.'));
                }
            }
        }
        $permissions = $this->Users->Permissions->find('list', array(
            'order' => array(
                'permission_name'
            )
        ));
        $this->set(compact('permissions', 'user'));
    }

    public function isAuthorized($user = null)
    {
        if ($user == null) {
            return false;
        }

        switch ($this->request->getParam('action')) {
            case 'index':
            case 'view':
                return $this->Permissions->CheckSitePermission($this->Auth->user('user_id'), Permission::$ViewUsers);
                break;
            case 'edit':
            case 'editPermissions':
            case 'delete':
                return $this->Permissions->CheckSitePermission($this->Auth->user('user_id'), Permission::$EditUsers);
                break;
        }
        return false;
    }
}
