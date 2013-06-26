<?php
App::uses('AppController', 'Controller');
/**
 * Templates Controller
 *
 * @property Template $Template
 * @property RagnarokPermissionsComponent RagnarokPermissions
 */
class TemplatesController extends AppController
{

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('index', 'view');
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
        $this->Template->recursive = 0;
        $this->Paginator->settings = array(
            'order' => array(
                'Template.template_name' => 'asc'
            )
        );
        $this->set('templates', $this->Paginator->paginate());
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
        if (!$this->Template->exists($id)) {
            throw new NotFoundException(__('Invalid template'));
        }
        $options = array(
            'conditions' => array(
                'Template.' . $this->Template->primaryKey => $id
            ),
            'contain' => array(
                'CreatedBy' => array(
                    'fields' => array(
                        'username'
                    )
                ),
                'UpdatedBy' => array(
                    'fields' => array(
                        'username'
                    )
                ),
                'TemplatePower' => array(
                    'Power'
                )
            )
        );
        $this->set('template', $this->Template->find('first', $options));
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
                $this->Template->create();
                $this->request->data['Template']['created_by_id'] = $this->Session->read('user_id');
                $this->request->data['Template']['updated_by_id'] = $this->Session->read('user_id');
                if ($this->Template->saveAll($this->request->data)) {
                    $this->Session->setFlash(__('The template has been saved'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The template could not be saved. Please, try again.'));
                    $this->set('errors', $this->Template->validationErrors);
                }
            }
        }
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
        if (!$this->Template->exists($id)) {
            throw new NotFoundException(__('Invalid template'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->request->data['action'] == 'Cancel') {
                $this->redirect(array('action' => 'view', $id));
            } else {
                $this->request->data['Template']['updated_by_id'] = $this->Session->read('user_id');
                if ($this->Template->saveAll($this->request->data)) {
                    $this->Session->setFlash(__('The template has been saved'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->set('errors', $this->Template->validationErrors);
                    $this->Session->setFlash(__('The template could not be saved. Please, try again.'));
                }
            }
        } else {
            $options = array(
                'conditions' => array(
                    'Template.' . $this->Template->primaryKey => $id
                ),
                'contain' => array(
                    'CreatedBy' => array(
                        'fields' => array(
                            'username'
                        )
                    ),
                    'UpdatedBy' => array(
                        'fields' => array(
                            'username'
                        )
                    )
                ),
            );

            $this->request->data = $this->Template->find('first', $options);
            $options = array(
                'conditions' => array(
                    'TemplatePower.template_id' => $id
                ),
                'contain' => array(
                    'Power'
                ),
                'order' => array(
                    'Power.power_name'
                )
            );
            $this->request->data['TemplatePower'] = $this->Template->TemplatePower->find('all', $options);
        }
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
        $this->Template->id = $id;
        if (!$this->Template->exists()) {
            throw new NotFoundException(__('Invalid template'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Template->delete()) {
            $this->Session->setFlash(__('Template deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Template was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function deletePower()
    {
        $this->Template->TemplatePower->id = $this->request->data['TemplatePower']['id'];
        if (!$this->Template->TemplatePower->exists()) {
            $result = array('result' => 'error', 'message' => 'Unknown Template Power');
            echo json_encode($result);
            die();
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Template->TemplatePower->delete()) {
            $result = array('result' => 'ok');
        } else {
            $result = array('result' => 'error', 'message' => 'Unable to delete power for template');
        }
        echo json_encode($result);
        die();
    }

    public function listPowers($templateId)
    {
        $powers = $this->Template->TemplatePower->find('all', array(
            'conditions' => array(
                'TemplatePower.template_id' => $templateId
            )
        ));
        $this->set(compact('powers'));
        $this->set('_serialize', array('powers'));
    }

    public function isAuthorized($user = null)
    {
        switch ($this->request->params['action']) {
            case 'add':
                return $this->Auth->loggedIn();
                break;
            case 'edit':
            case 'delete':
            case 'deletePower':
                return $this->RagnarokPermissions->CheckPermission($this->Session->Read('user_id'), Permission::$EditDatabase);
                break;
        }
        return false;
    }
}
