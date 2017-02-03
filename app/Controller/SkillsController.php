<?php
App::uses('AppController', 'Controller');
/**
 * Skills Controller
 *
 * @property Skill $Skill
 * @property RagnarokPermissionsComponent RagnarokPermissions
 */
class SkillsController extends AppController
{

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('index', 'view', 'getList');
        $actions = array('list' => true);
        if ($this->Auth->user()) {
            $actions['add'] = true;
        }
        if ($this->RagnarokPermissions->CheckPermission($this->Auth->user('user_id'), Permission::$EditDatabase)) {
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
        $this->Skill->recursive = 0;
        $this->Paginator->settings = [
            'Skill' => [
                'limit' => 20,
                'order' => 'Skill.skill_name'
            ]
        ];
        $this->set('skills', $this->Paginator->paginate());
    }

    /**
     * Retrieve a JSON list of skills from the database.
     */
    public function getList()
    {
        $skills = $this->Skill->find(
            'list',
            array(
                'conditions' => array(
                    'Skill.skill_name like' => $this->request->query['term'] . '%'
                ),
                'contain' => false,
                'order' => 'skill_name'
            )
        );

        $items = array();
        foreach($skills as $value => $label)
        {
            $output['value'] = $value;
            $output['label'] = $label;
            $items[] = $output;
        }
        echo json_encode($items);
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
        if (!$this->Skill->exists($id)) {
            throw new NotFoundException(__('Invalid skill'));
        }
        $options = array('conditions' => array('Skill.' . $this->Skill->primaryKey => $id));
        $this->set('skill', $this->Skill->find('first', $options));
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
                $this->Skill->create();
                if ($this->Skill->save($this->request->data)) {
                    $this->Session->setFlash(__('The skill has been saved'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The skill could not be saved. Please, try again.'));
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
        if (!$this->Skill->exists($id)) {
            throw new NotFoundException(__('Invalid skill'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->request->data['action'] == 'Cancel') {
                $this->redirect(array('action' => 'index'));
            } else {
                if ($this->Skill->save($this->request->data)) {
                    $this->Session->setFlash(__('The skill has been saved'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The skill could not be saved. Please, try again.'));
                }
            }
        } else {
            $options = array('conditions' => array('Skill.' . $this->Skill->primaryKey => $id));
            $this->request->data = $this->Skill->find('first', $options);
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
        $this->Skill->id = $id;
        if (!$this->Skill->exists()) {
            throw new NotFoundException(__('Invalid skill'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Skill->delete()) {
            $this->Session->setFlash(__('Skill deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Skill was not deleted'));
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
                return $this->RagnarokPermissions->CheckPermission($this->Auth->user('user_id'), Permission::$EditDatabase);
                break;
        }
        return false;
    }
}
