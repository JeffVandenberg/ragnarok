<?php
App::uses('AppController', 'Controller');
/**
 * Requests Controller
 *
 * @property RagRequest RagRequest
 * @property mixed RagnarokPermissions
 */
class RequestsController extends AppController
{
    public $uses = array('RagRequest');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->deny();

        $this->Paginator->settings = array(
            'RagRequest' => array(
                'limit' => 20,
                'order' => 'RagRequest.updated'
            )
        );
        $this->Session->setFlash('Requests are in Beta Stage!');
    }

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->RagRequest->recursive = 0;
        $this->set('requests', $this->Paginator->paginate());
    }

    public function character($id)
    {
        if (!$this->validateUserCharacter($id)) {
            $this->Flash->set('You are not authorized for that character.');
            $this->redirect(array('controller' => 'welcome', 'action' => 'home'));
        }

        $this->Paginator->settings['RagRequest']['contain'] = array(
            'Character' => array(
                'character_name'
            ),
            'UpdatedBy' => array(
                'user_id',
                'username'
            ),
            'RequestType',
            'RequestStatus',
            'Group'
        );
        $this->set('requests', $this->Paginator->paginate('RagRequest', array(
            'RagRequest.character_id' => $id
        )));
        $options = array(
            'conditions' => array(
                'Character.id' => $id
            )
        );
        $this->set('character', $this->RagRequest->Character->find('first', $options));
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
        if (!$this->RagRequest->exists($id)) {
            throw new NotFoundException(__('Invalid request'));
        }
        $options = array(
            'conditions' => array(
                'RagRequest.id' => $id
            ),
            'contain' => array(
                'RequestNote' => array(
                    'CreatedBy' => array(
                        'username'
                    )
                ),
                'RequestBluebook' => array(
                    'Bluebook' => array(
                        'title',
                        'created'
                    )
                ),
                'RequestType',
                'RequestStatus',
                'UpdatedBy' => array(
                    'user_id',
                    'username'
                ),
                'CreatedBy' => array(
                    'user_id',
                    'username'
                ),
                'Group'
            )
        );
        $this->set('request', $this->RagRequest->find('first', $options));
    }

    /**
     * add method
     *
     * @param int $characterId
     * @return void
     */
    public function add($characterId)
    {
        if (!$this->validateUserCharacter($characterId)) {
            $this->Session->setFlash('You are not authorized for that character.');
            $this->redirect(array('controller' => 'welcome', 'action' => 'home'));
        }

        if ($this->request->is('post')) {
            App::uses('RequestStatus', 'Model');
            $this->RagRequest->create();
            $this->request->data['RagRequest']['created_by_id'] = $this->Auth->user('user_id');
            $this->request->data['RagRequest']['updated_by_id'] = $this->Auth->user('user_id');
            $this->request->data['RagRequest']['request_status_id'] = RequestStatus::NewRequest;
            if ($this->RagRequest->save($this->request->data)) {
                $this->Session->setFlash(__('The request has been created'));
                $this->redirect(array('action' => 'view', $this->RagRequest->id));
            } else {
                $this->Session->setFlash(__('The request could not be saved. Please, try again.'));
            }
        }
        $requestTypes = $this->RagRequest->RequestType->find('list');
        $groups = $this->RagRequest->Group->find('list');
        $this->set(compact('requestTypes', 'groups', 'characterId'));
    }

    public function addNote($requestId)
    {
        if (!$this->validateRequestView($requestId, $this->Auth->user('user_id'))) {
            $this->Session->setFlash('You are not authorized to view that request');
            $this->redirect('/');
        }

        if ($this->request->is('post')) {
            if ($this->request->data['action'] == 'Cancel') {
                $this->redirect(array('action' => 'view', $requestId));
            }
            if ($this->request->data['action'] == 'Add Note') {
                // add note
                $item = array();
                $item['request_id'] = $requestId;
                $item['note'] = $this->request->data['request_note'];
                $item['created_by_id'] = $this->Auth->user('user_id');
                if ($this->RagRequest->RequestNote->save($item)) {
                    $this->Session->setFlash('Added Note');
                    $this->redirect(array('action' => 'view', $requestId));
                } else {
                    $this->Session->setFlash('Error Saving Note');
                }
            }
        }
        $options = array(
            'conditions' => array(
                'RagRequest.id' => $requestId
            ),
            'contain' => false
        );

        $this->request->data = $this->RagRequest->find('first', $options);
    }

    public function addBluebook($requestId)
    {
        if (!$this->validateRequestView($requestId, $this->Auth->user('user_id'))) {
            $this->Session->setFlash('You are not authorized to view that request');
            $this->redirect('/');
        }

        if ($this->request->is('post')) {
            if ($this->request->data['action'] == 'Cancel') {
                $this->redirect(array('action' => 'view', $requestId));
            }
            if ($this->request->data['action'] == 'Add Entry') {
                // add note
                $item = array();
                $item['request_id'] = $requestId;
                $item['bluebook_id'] = $this->request->data['bluebook_id'];
                $item['created_by_id'] = $this->Auth->user('user_id');
                if ($this->RagRequest->RequestBluebook->save($item)) {
                    $this->Session->setFlash('Added Bluebook Entries');
                    $this->redirect(array('action' => 'view', $requestId));
                } else {
                    $this->Session->setFlash('Error Saving Note');
                }
            }
        }

        $options = array(
            'conditions' => array(
                'RagRequest.id' => $requestId
            ),
            'contain' => false
        );
        $request = $this->RagRequest->find('first', $options);
        $bluebooks = $this->RagRequest->RequestBluebook->Bluebook->find('list', array(
            'conditions' => array(
                'Bluebook.character_id' => $request['RagRequest']['character_id']
            )
        ));
        $this->set(compact('request', 'bluebooks'));
    }

    public function addRequest($requestId)
    {
        if (!$this->validateRequestView($requestId, $this->Auth->user('user_id'))) {
            $this->Session->setFlash('You are not authorized to view that request');
            $this->redirect('/');
        }

        if ($this->request->is('post')) {
            if ($this->request->data['action'] == 'Cancel') {
                $this->redirect(array('action' => 'view', $requestId));
            }
            if ($this->request->data['action'] == 'Add Note') {
            }
        }
        $request = $this->RagRequest->find('first', array(
            'conditions' => array(
                'RagRequest.id' => $requestId
            ),
            'contain' => false
        ));

        $options = array(
            'conditions' => array(
                'RagRequest.character_id' => $request['RagRequest']['character_id']
            ),
            'contain' => false,
            'order' => 'title'
        );

        $requests = $this->RagRequest->find('list', $options);
        $this->set(compact('requests', 'request'));;
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
        if (!$this->RagRequest->exists($id)) {
            throw new NotFoundException(__('Invalid request'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->RagRequest->save($this->request->data)) {
                $this->Session->setFlash(__('The request has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The request could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('RagRequest.' . $this->Request->primaryKey => $id));
            $this->request->data = $this->RagRequest->find('first', $options);
        }
        $characters = $this->RagRequest->Character->find('list');
        $requestTypes = $this->RagRequest->RequestType->find('list');
        $requestStatuses = $this->RagRequest->RequestStatus->find('list');
        $createdBies = $this->RagRequest->CreatedBy->find('list');
        $updatedBies = $this->RagRequest->UpdatedBy->find('list');
        $requests = $this->RagRequest->Request->find('list');
        $this->set(compact('characters', 'requestTypes', 'requestStatuses', 'createdBies', 'updatedBies', 'requests'));
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
        $this->RagRequest->id = $id;
        if (!$this->RagRequest->exists()) {
            throw new NotFoundException(__('Invalid request'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->RagRequest->delete()) {
            $this->Session->setFlash(__('Request deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Request was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function isAuthorized($user = null)
    {
        switch ($this->request->params['action']) {
            case 'add':
            case 'addNote':
            case 'addBluebook':
            case 'addRequest':
            case 'view':
            case 'character':
                return $this->Auth->loggedIn();
                break;
            case 'getList':
            case 'gmView':
                return $this->RagnarokPermissions->CheckPermission($this->Auth->user('user_id'), Permission::$GameMaster);
                break;
            case 'cast':
                return true;
                break;
        }
        return false;
    }

    private function validateRequestView($requestId, $userId)
    {
        return $this->RagRequest->verifyRequestAccess($requestId, $userId);
    }

}
