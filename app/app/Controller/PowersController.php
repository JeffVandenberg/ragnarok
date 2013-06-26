<?php
App::uses('AppController', 'Controller');
/**
 * Powers Controller
 *
 * @property Power $Power
 * @property RagnarokPermissionsComponent RagnarokPermissions
 */
class PowersController extends AppController
{
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('index', 'view', 'getList');
        $actions = array('list' => true);
        if($this->Auth->loggedIn())
        {
            $actions['add'] = true;
        }
        if($this->RagnarokPermissions->CheckPermission($this->Session->read('user_id'), Permission::$EditDatabase))
        {
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
        $this->Power->recursive = 0;
        $this->Paginator->settings = array(
            'order' => array(
                'Power.power_name' => 'asc'
            )
        );
        $this->set('powers', $this->Paginator->paginate());
    }

    /**
     * Retrieve a JSON list of skills from the database.
     */
    public function getList()
    {
        $powers = $this->Power->find(
            'all',
            array(
                'conditions' => array(
                    'Power.power_name like' => $this->request->query['term'] . '%'
                ),
                'contain' => false,
                'order' => 'power_name'
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
        if (!$this->Power->exists($id)) {
            throw new NotFoundException(__('Invalid power'));
        }
        $options = array('conditions' => array('Power.' . $this->Power->primaryKey => $id));
        $this->set('power', $this->Power->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            if ($this->request->data['action'] == 'Cancel') {
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Power->create();
                $this->request->data['Power']['created_by_id'] = $this->Session->read('user_id');
                $this->request->data['Power']['updated_by_id'] = $this->Session->read('user_id');
                if ($this->Power->save($this->request->data)) {
                    $this->Session->setFlash(__('The power has been saved'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The power could not be saved. Please, try again.'));
                }
            }
        }
        $createdBies = $this->Power->CreatedBy->find('list');
        $updatedBies = $this->Power->UpdatedBy->find('list');
        $this->set(compact('createdBies', 'updatedBies'));
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
        if (!$this->Power->exists($id)) {
            throw new NotFoundException(__('Invalid power'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->request->data['action'] == 'Cancel') {
                $this->redirect(array('action' => 'view', $id));
            } else {
                $this->request->data['Power']['updated_by_id'] = $this->Session->read('user_id');
                if ($this->Power->save($this->request->data)) {
                    $this->Session->setFlash(__('The power has been saved'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The power could not be saved. Please, try again.'));
                }
            }
        } else {
            $options = array('conditions' => array('Power.' . $this->Power->primaryKey => $id));
            $this->request->data = $this->Power->find('first', $options);
        }
        $createdBies = $this->Power->CreatedBy->find('list');
        $updatedBies = $this->Power->UpdatedBy->find('list');
        $this->set(compact('createdBies', 'updatedBies'));
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
        $this->Power->id = $id;
        if (!$this->Power->exists()) {
            throw new NotFoundException(__('Invalid power'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Power->delete()) {
            $this->Session->setFlash(__('Power deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Power was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function isAuthorized($user = null)
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
