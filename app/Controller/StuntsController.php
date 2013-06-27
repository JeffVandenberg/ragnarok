<?php
App::uses('AppController', 'Controller');
/**
 * Stunts Controller
 *
 * @property Stunt $Stunt
 * @property RagnarokPermissionsComponent RagnarokPermissions
 */
class StuntsController extends AppController
{

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('view', 'index', 'getList');
        $actions = array('list' => true);
        if ($this->Auth->loggedIn()) {
            $actions['add'] = true;
        }
        if ($this->RagnarokPermissions->CheckPermission($this->Session->read('user_id'), Permission::$EditDatabase)) {
            $actions['edit'] = true;
        }
        $this->set('actions', $actions);
    }

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->Stunt->recursive = 0;
        $this->Paginator->settings = array(
            'order' => array(
                'Stunt.stunt_name' => 'asc'
            )
        );
        $this->set('stunts', $this->Paginator->paginate());
    }

    /**
     * Retrieve a JSON list of powers from the database.
     */
    public function getList()
    {
        $powers = $this->Stunt->find(
            'all',
            array(
                'conditions' => array(
                    'Stunt.stunt_name like' => $this->request->query['term'] . '%'
                ),
                'contain' => array(
                    'Skill' => array(
                        'skill_name'
                    )
                ),
                'order' => 'stunt_name'
            )
        );

        echo json_encode($powers);
        die();
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
        if (!$this->Stunt->exists($id)) {
            throw new NotFoundException(__('Invalid stunt'));
        }
        $options = array('conditions' => array('Stunt.' . $this->Stunt->primaryKey => $id));
        $this->set('stunt', $this->Stunt->find('first', $options));
        $this->set('isGm', $this->RagnarokPermissions->CheckPermission($this->Session->read('user_id'), Permission::$GameMaster));
        $this->set('isAjax', $this->request->is('ajax'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            if (isset($this->request->data['action']) && ($this->request->data['action'] == 'Cancel')) {
                $this->redirect(array('action' => 'index'));
            } else {
                $result = array();
                $this->Stunt->create();
                if(!isset($this->request->data['Stunt']['is_approved']))
                {
                    $this->request->data['Stunt']['is_approved'] = false;
                }
                if(!isset($this->request->data['Stunt']['is_official']))
                {
                    $this->request->data['Stunt']['is_official'] = false;
                }
                $this->request->data['Stunt']['created_by_id'] = $this->Session->read('user_id');
                $this->request->data['Stunt']['updated_by_id'] = $this->Session->read('user_id');
                if ($this->Stunt->save($this->request->data)) {
                    if($this->request->is('ajax')) {
                        $options = array(
                            'conditions' => array(
                                'Stunt.' . $this->Stunt->primaryKey => $this->Stunt->id
                            ),
                            'contain' => false
                        );
                        $result = $this->Stunt->find('first', $options);
                        $result['result'] = 'ok';
                    }
                    else {
                        $this->Session->setFlash(__('The stunt has been saved'));
                        $this->redirect(array('action' => 'index'));
                    }
                } else {
                    if($this->request->is('ajax')) {
                        $result = array (
                            'result' => 'error',
                            'message' => $this->Stunt->validationErrors
                        );
                    }
                    else {
                        $this->Session->setFlash(__('The stunt could not be saved. Please, try again.'));
                    }
                }

                if($this->request->is('ajax')) {
                    header('content-type: application/json');
                    echo json_encode($result);
                    die();
                }
            }
        }
        if(isset($this->request->query['name'])) {
            $this->request->data['Stunt']['stunt_name'] = $this->request->query['name'];
            $this->request->data['Stunt']['cost'] = -1;
        }
        $skills = $this->Stunt->Skill->find('list');
        $createdBies = $this->Stunt->CreatedBy->find('list');
        $updatedBies = $this->Stunt->UpdatedBy->find('list');
        $isAjax = $this->request->is('ajax');
        $showAdmin = $this->RagnarokPermissions->CheckPermission($this->Session->read('user_id'), Permission::$EditDatabase);
        $this->set(compact('skills', 'createdBies', 'updatedBies', 'isAjax', 'showAdmin'));
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
        if (!$this->Stunt->exists($id)) {
            throw new NotFoundException(__('Invalid stunt'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->request->data['action'] == 'Cancel') {
                $this->redirect(array('action' => 'view', $id));
            } else {
                $this->request->data['Stunt']['updated_by_id'] = $this->Session->read('user_id');
                if ($this->Stunt->save($this->request->data)) {
                    $this->Session->setFlash(__('The stunt has been saved'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The stunt could not be saved. Please, try again.'));
                }
            }
        } else {
            $options = array('conditions' => array('Stunt.' . $this->Stunt->primaryKey => $id));
            $this->request->data = $this->Stunt->find('first', $options);
        }
        $skills = $this->Stunt->Skill->find('list');
        $createdBies = $this->Stunt->CreatedBy->find('list');
        $updatedBies = $this->Stunt->UpdatedBy->find('list');
        $this->set(compact('skills', 'createdBies', 'updatedBies'));
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
        $this->Stunt->id = $id;
        if (!$this->Stunt->exists()) {
            throw new NotFoundException(__('Invalid stunt'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Stunt->delete()) {
            $this->Session->setFlash(__('Stunt deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Stunt was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function isAuthorized($user = true)
    {
        switch ($this->request->params['action']) {
            case 'add':
                return $this->Auth->loggedIn();
                break;
            case 'edit':
            case 'delete':
                return $this->RagnarokPermissions->CheckPermission($this->Session->Read('user_id'), Permission::$EditDatabase);
                break;
        }
        return false;
    }
}
