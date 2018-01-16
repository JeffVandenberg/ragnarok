<?php
namespace App\Controller;

use App\Controller\Component\PermissionsComponent;
use App\Model\Entity\Permission;
use App\Model\Table\TemplatesTable;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

/**
 * Templates Controller
 *
 * @property TemplatesTable $Templates
 * @property PermissionsComponent $Permissions
 */
class TemplatesController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index', 'view']);
        $actions = array('list' => true);
        if ($this->Auth->user('user_id') != 1) {
            $actions['add'] = true;
        }
        if ($this->Permissions->CheckSitePermission($this->Auth->user('user_id'), Permission::$EditDatabase)) {
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
        $this->paginate = [
            'order' => [
                'Templates.template_name' => 'asc'
            ],
            'contain' => [
                'CreatedBy' => [
                    'fields' => ['username']
                ]
            ]
        ];

        $templates = $this->paginate($this->Templates);

        $this->set(compact('templates'));
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
        $template = $this->Templates->get($id, [
            'contain' => [
                'CreatedBy' => [
                    'fields' => ['username']
                ],
                'UpdatedBy' => [
                    'fields' => ['username']
                ],
                'TemplatePowers' => [
                    'Powers'
                ]
            ]
        ]);
        $this->set('template', $template);
    }

    /**
     * add method
     *
     * @return \Cake\Http\Response|null
     */
    public function add()
    {
        $template = $this->Templates->newEntity();
        if ($this->request->is(['post', 'put'])) {
            if (strtolower($this->request->getData('action')) == 'cancel') {
                $this->redirect(['action' => 'index']);
                return null;
            }
            $template = $this->Templates->patchEntity($template, $this->request->getData());
            $template->created_by_id = $template->updated_by_id = $this->Auth->user('user_id');
            if ($this->Templates->save($template, ['associated' => 'TemplatePowers'])) {
                $this->Flash->success(__('The template has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The template could not be saved. Please, try again.'));
        }

        $this->set(compact('template'));
    }

    /**
     * edit method
     *
     * @param string $id
     * @return \Cake\Http\Response|null
     */
    public function edit($id = null)
    {
        $template = $this->Templates->get($id, [
            'contain' => [
                'TemplatePowers' => [
                    'Powers'
                ],
                'CreatedBy' => [
                    'fields' => ['username']
                ],
                'UpdatedBy' => [
                    'fields' => ['username']
                ]
            ]
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if (strtolower($this->request->getData('action')) == 'cancel') {
                $this->redirect(['action' => 'index']);
                return null;
            }
            $template = $this->Templates->patchEntity($template, $this->request->getData());
            $template->updated_by = $this->Auth->user('user_id');
            if ($this->Templates->save($template, ['associated' => 'TemplatePowers'])) {
                $this->Flash->success(__('The template has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The template could not be saved. Please, try again.'));
        }

        $this->set(compact('template'));
    }

    /**
     * delete method
     *
     * @param string $id
     * @return \Cake\Http\Response|null
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $power = $this->Templates->get($id);
        if ($this->Templates->delete($power)) {
            $this->Flash->success(__('The power has been deleted.'));
        } else {
            $this->Flash->error(__('The power could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function deletePower()
    {
        $this->request->allowMethod(['post', 'delete']);
        $templatePower = $this->Templates->TemplatePowers->get(
            $this->request->getData('template_power_id'),
            ['contain' => []]
        );
        if ($this->Templates->TemplatePowers->delete($templatePower)) {
            $result = array('result' => 'ok');
        } else {
            $result = array('result' => 'error', 'message' => 'Unable to delete power for template');
        }
        echo json_encode($result);
        die();
    }

    public function listPowers($templateId)
    {
        $powers = $this->Templates->TemplatePowers->find('all', array(
            'conditions' => array(
                'TemplatePowers.template_id' => $templateId
            ),
            'contain' => [
                'Powers' => [
                    'fields' => ['power_name']
                ]
            ]
        ));
        $this->set(compact('powers'));
        $this->set('_serialize', array('powers'));
    }

    public function isAuthorized($user = null)
    {
        switch ($this->request->getParam('action')) {
            case 'add':
            case 'listPowers':
                return $this->Auth->user('user_id') != 1;
                break;
            case 'edit':
            case 'delete':
            case 'deletePower':
                return $this->Permissions->CheckSitePermission($this->Auth->user('user_id'), Permission::$EditDatabase);
                break;
        }
        return false;
    }
}
