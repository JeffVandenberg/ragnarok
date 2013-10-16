<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property RagnarokPermissionsComponent $RagnarokPermissions
 * @property User $User
 */
class UsersController extends AppController {
    public function beforeFilter()
    {
        parent::beforeFilter();
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
        $this->Paginator->settings = array(
            'order' => 'User.username_clean'
        );
 		$this->set('users', $this->Paginator->paginate('User', array('User.user_type !=' => 2)));
        $actions = array();
        if($this->RagnarokPermissions->CheckPermission($this->Auth->user('user_id'), Permission::$EditUsers))
        {
            $actions['edit'] = true;
        }
        $this->set(compact('actions'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array(
            'conditions' => array(
                'User.' . $this->User->primaryKey => $id
            ),
            'contain' => array(
                'Permission' => array(
                    'order' => array(
                        'Permission.permission_name'
                    )
                )
            )
        );
		$this->set('user', $this->User->find('first', $options));
        if($this->RagnarokPermissions->CheckPermission($this->Auth->user('user_id'), Permission::$EditUsers))
        {
            $actions['edit'] = true;
        }
        $this->set(compact('actions'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$userStatuses = $this->User->UserStatus->find('list');
		$userTypes = $this->User->UserType->find('list');
		$games = $this->User->Game->find('list');
		$this->set(compact('userStatuses', 'userTypes', 'games'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$userStatuses = $this->User->UserStatus->find('list');
		$userTypes = $this->User->UserType->find('list');
		$games = $this->User->Game->find('list');
		$this->set(compact('userStatuses', 'userTypes', 'games'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

    public function login()
    {
        if($this->request->is('post'))
        {

        }
    }

    public function editPermissions($id = null)
    {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->request->data['action'] == 'Cancel') {
                $this->redirect(array('action' => 'view', $id));
            } else {
                $this->request->data['User']['updated_by_id'] = $this->Auth->user('user_id');
                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('The user\'s permissions have been updated.'));
                    $this->redirect(array('action' => 'view', $this->request->data['User']['user_id']));
                } else {
                    $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
                }
            }
        } else {
            $options = array(
                'conditions' => array(
                    'User.' . $this->User->primaryKey => $id
                ),
                'contain' => array(
                    'Permission'
                )
            );
            $this->request->data = $this->User->find('first', $options);
        }
        $permissions = $this->User->Permission->find('list', array(
            'order' => array(
                'permission_name'
            )
        ));
        $this->set(compact('permissions'));
    }

    public function isAuthorized($user = null)
    {
        if($user == null)
        {
            return false;
        }

        switch ($this->request->params['action']) {
            case 'index':
            case 'view':
            return $this->RagnarokPermissions->CheckPermission($this->Auth->user('user_id'), Permission::$ViewUsers);
                break;
            case 'edit':
            case 'editPermissions':
            case 'delete':
                return $this->RagnarokPermissions->CheckPermission($this->Auth->user('user_id'), Permission::$EditUsers);
                break;
        }
        return false;
    }
}
