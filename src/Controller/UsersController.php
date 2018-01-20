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
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        if (!$this->Users->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array(
            'conditions' => array(
                'User.' . $this->Users->primaryKey => $id
            ),
            'contain' => array(
                'Permission' => array(
                    'order' => array(
                        'Permission.permission_name'
                    )
                )
            )
        );
        $this->set('user', $this->Users->find('first', $options));
        if ($this->Permissions->CheckPermission($this->Auth->user('user_id'), Permission::$EditUsers)) {
            $actions['edit'] = true;
        }
        $this->set(compact('actions'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Users->create();
            if ($this->Users->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
        $userStatuses = $this->Users->UserStatus->find('list');
        $userTypes = $this->Users->UserType->find('list');
        $games = $this->Users->Game->find('list');
        $this->set(compact('userStatuses', 'userTypes', 'games'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        if (!$this->Users->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Users->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->Users->primaryKey => $id));
            $this->request->data = $this->Users->find('first', $options);
        }
        $userStatuses = $this->Users->UserStatus->find('list');
        $userTypes = $this->Users->UserType->find('list');
        $games = $this->Users->Game->find('list');
        $this->set(compact('userStatuses', 'userTypes', 'games'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        $this->Users->id = $id;
        if (!$this->Users->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Users->delete()) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function login()
    {
        if ($this->request->is('post')) {

        }
    }

    public function editPermissions($id = null)
    {
        if (!$this->Users->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->request->data['action'] == 'Cancel') {
                $this->redirect(array('action' => 'view', $id));
            } else {
                $this->request->data['User']['updated_by_id'] = $this->Auth->user('user_id');
                if ($this->Users->save($this->request->data)) {
                    $this->Session->setFlash(__('The user\'s permissions have been updated.'));
                    $this->redirect(array('action' => 'view', $this->request->data['User']['user_id']));
                } else {
                    $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
                }
            }
        } else {
            $options = array(
                'conditions' => array(
                    'User.' . $this->Users->primaryKey => $id
                ),
                'contain' => array(
                    'Permission'
                )
            );
            $this->request->data = $this->Users->find('first', $options);
        }
        $permissions = $this->Users->Permission->find('list', array(
            'order' => array(
                'permission_name'
            )
        ));
        $this->set(compact('permissions'));
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
