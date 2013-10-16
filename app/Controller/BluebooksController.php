<?php
App::uses('AppController', 'Controller');
/**
 * Bluebooks Controller
 *
 * @property Bluebook $Bluebook
 * @property mixed RagnarokPermissions
 */
class BluebooksController extends AppController
{

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->deny();

        $this->Paginator->settings = array(
            'Bluebook' => array (
                'limit' => 20,
                'order' => array (
                    'Bluebook.updated' => 'DESC'
                )
            )
        );
    }

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->Bluebook->recursive = 0;
        $this->set('bluebooks', $this->Paginator->paginate());
    }

    public function character($id)
    {
        if (!$this->validateUserCharacter($id)) {
            $this->Session->setFlash('You are not authorized for that character.');
            $this->redirect(array('controller' => 'welcome', 'action' => 'home'));
        }

        $this->Paginator->settings['Bluebook']['contain'] = array(
            'Character' => array(
                'character_name'
            ),
            'UpdatedBy' => array(
                'user_id',
                'username'
            ),
            'BluebookStatus',
        );
        $this->set('bluebooks', $this->Paginator->paginate('Bluebook', array(
            'Bluebook.character_id' => $id
        )));
        $options = array(
            'conditions' => array(
                'Character.id' => $id
            )
        );
        $this->set('character', $this->Bluebook->Character->find('first', $options));
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
        if (!$this->Bluebook->exists($id)) {
            throw new NotFoundException(__('Invalid bluebook'));
        }
        if (!$this->MayAccessBluebook($id)) {
            $this->Session->setFlash('You are not authorized for that entry.');
            $this->redirect(array('controller' => 'welcome', 'action' => 'home'));
        }
        $options = array('conditions' => array('Bluebook.' . $this->Bluebook->primaryKey => $id));
        $this->set('bluebook', $this->Bluebook->find('first', $options));
    }

    /**
     * add method
     *
     * @param $characterId
     * @return void
     */
    public function add($characterId)
    {
        if (!$this->validateUserCharacter($characterId)) {
            $this->Session->setFlash('You are not authorized for that character.');
            $this->redirect(array('controller' => 'welcome', 'action' => 'home'));
        }
        if ($this->request->is('post')) {
            App::uses('BluebookStatus', 'Model');
            $this->Bluebook->create();
            $this->request->data['Bluebook']['character_id'] = $characterId;
            $this->request->data['Bluebook']['bluebook_status_id'] = BluebookStatus::NewEntry;
            $this->request->data['Bluebook']['created_by_id'] = $this->Auth->user('user_id');
            $this->request->data['Bluebook']['updated_by_id'] = $this->Auth->user('user_id');

            if ($this->Bluebook->save($this->request->data)) {
                $this->Session->setFlash(__('The bluebook has been saved'));
                $this->redirect(array('action' => 'character', $characterId));
            } else {
                $this->Session->setFlash(__('The bluebook could not be saved. Please, try again.'));
            }
        }
        $bluebookStatuses = $this->Bluebook->Request->find('list');
        $this->set(compact('bluebookStatuses'));
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
        if (!$this->Bluebook->exists($id)) {
            throw new NotFoundException(__('Invalid bluebook'));
        }
        if (!$this->MayAccessBluebook($id)) {
            $this->Session->setFlash('You are not authorized for that entry.');
            $this->redirect(array('controller' => 'welcome', 'action' => 'home'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            //$this->request->data['Bluebook']['id'] = $id;
            if ($this->request->data['action'] == 'Cancel') {
                $this->redirect(array('action' => 'view', $id));
            } else {
                $this->request->data['Bluebook']['updated_by_id'] = $this->Auth->user('user_id');
                if ($this->Bluebook->save($this->request->data)) {
                    $this->Session->setFlash(__('The bluebook has been saved'));
                    $this->redirect(array('action' => 'view', $id));
                } else {
                    $this->Session->setFlash(__('The bluebook could not be saved. Please, try again.'));
                }
            }
        } else {
            $options = array('conditions' => array('Bluebook.' . $this->Bluebook->primaryKey => $id));
            $this->request->data = $this->Bluebook->find('first', $options);
        }
        $characters = $this->Bluebook->Character->find('list');
        $createdBies = $this->Bluebook->CreatedBy->find('list');
        $updatedBies = $this->Bluebook->UpdatedBy->find('list');
        $requests = $this->Bluebook->Request->find('list');
        $this->set(compact('characters', 'createdBies', 'updatedBies', 'requests'));
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
        $this->Bluebook->id = $id;
        if (!$this->Bluebook->exists()) {
            throw new NotFoundException(__('Invalid bluebook'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Bluebook->delete()) {
            $this->Session->setFlash(__('Bluebook deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Bluebook was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function isAuthorized($user = null)
    {
        switch ($this->request->params['action']) {
            case 'add':
            case 'edit':
            case 'view':
            case 'character':
                return $this->Auth->loggedIn();
                break;
            case 'getList':
            case 'gmView':
                return $this->RagnarokPermissions->CheckPermission($this->Auth->user('user_id'), Permission::$GameMaster);
                break;
        }
        return false;
    }

    private function MayAccessBluebook($id)
    {
        return ($this->Bluebook->MayViewEntry($id, $this->Auth->user('user_id')));
    }
}
