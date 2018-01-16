<?php
namespace App\Controller;

use App\Controller\Component\PermissionsComponent;
use App\Model\Entity\Permission;
use App\Model\Table\PowersTable;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Network\Exception\NotFoundException;
use function compact;
use function strtolower;

/**
 * Powers Controller
 *
 * @property PowersTable $Powers
 * @property PermissionsComponent Permissions
 */
class PowersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index', 'view', 'getList']);
        $actions = array('list' => true);
        if($this->Auth->user('user_id') != 1)
        {
            $actions['add'] = true;
        }
        if($this->Permissions->CheckSitePermission($this->Auth->user('user_id'), Permission::$EditDatabase))
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
        $this->paginate = [
            'order' => [
                'Powers.power_name' => 'asc'
            ],
            'contain' => [
                'CreatedBy' => [
                    'fields' => ['username']
                ]
            ]
        ];

        $powers = $this->paginate($this->Powers);

        $this->set(compact('powers'));
    }

    /**
     * Retrieve a JSON list of powers from the database.
     */
    public function getList()
    {
        $data = $this->Powers->query()
            ->where([
                'Powers.power_name like' => $this->request->getQuery('term') . '%'
            ])
            ->contain(false)
            ->order([
                'power_name'
            ])
            ->toArray();

        $this->set(compact('data'));
        $this->set('_serialize', ['data']);

        // TODO: refactor to not need to do this
        echo json_encode($data);
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
        $power = $this->Powers->get($id, [
            'contain' => ['CreatedBy', 'UpdatedBy', 'CharacterPowers', 'TemplatePowers']
        ]);

        $this->set('power', $power);
    }

    /**
     * add method
     *
     * @return \Cake\Http\Response|null
     */
    public function add()
    {
        $power = $this->Powers->newEntity();
        if ($this->request->is('post')) {
            if (strtolower($this->request->getData('action')) == 'cancel') {
                $this->redirect(['action' => 'index']);
                return null;
            }
            $power = $this->Powers->patchEntity($power, $this->request->getData());
            $power->created_by_id = $power->updated_by_id = $this->Auth->user('user_id');
            if ($this->Powers->save($power)) {
                $this->Flash->success(__('The power has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The power could not be saved. Please, try again.'));
        }
        $this->set(compact('power'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Power id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $power = $this->Powers->get($id);
        if ($this->Powers->delete($power)) {
            $this->Flash->success(__('The power has been deleted.'));
        } else {
            $this->Flash->error(__('The power could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * edit method
     *
     * @return \Cake\Http\Response|null
     * @throws NotFoundException
     * @param string $id
     */
    public function edit($id = null)
    {
        $power = $this->Powers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if (strtolower($this->request->getData('action')) == 'cancel') {
                $this->redirect(['action' => 'index']);
                return null;
            }
            $power = $this->Powers->patchEntity($power, $this->request->getData());
            $power->updated_by_id = $this->Auth->user('user_id');
            if ($this->Powers->save($power)) {
                $this->Flash->success(__('The power has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The power could not be saved. Please, try again.'));
        }

        $this->set(compact('power'));
    }

    public function isAuthorized($user = null)
    {
        switch ($this->request->getParam('action')) {
            case 'add':
                return $this->Auth->user('user_id') != 1;
                break;
            case 'edit':
            case 'delete':
                return $this->Permissions->CheckSitePermission($this->Auth->user('user_id'), Permission::$EditDatabase);
                break;
        }
        return false;
    }
}
