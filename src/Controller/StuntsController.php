<?php
namespace App\Controller;

use App\Controller\Component\PermissionsComponent;
use App\Model\Entity\Permission;
use App\Model\Table\StuntsTable;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

/**
 * Stunts Controller
 *
 * @property StuntsTable $Stunts
 * @property PermissionsComponent $Permissions
 */
class StuntsController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['view', 'index', 'getList']);
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
                'Stunts.stunt_name' => 'asc'
            ],
            'contain' => [
                'Skills',
                'CreatedBy' => [
                    'fields' => ['username']
                ]
            ]
        ];

        $stunts = $this->paginate($this->Stunts);

        $this->set(compact('stunts'));
    }

    /**
     * Retrieve a JSON list of powers from the database.
     */
    public function getList()
    {
        $data = $this->Stunts->query()
            ->where([
                'Stunts.stunt_name like' => $this->request->getQuery('term') . '%'
            ])
            ->contain([
                'Skills' => [
                    'fields' => ['skill_name']
                ]
            ])
            ->order([
                'stunt_name'
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
        $stunt = $this->Stunts->get($id, [
            'contain' => [
                'Skills',
                'CreatedBy' => [
                    'fields' => ['username']
                ],
                'UpdatedBy' => [
                    'fields' => ['username']
                ],
            ]
        ]);
        $this->set('stunt', $stunt);
        $this->set('isGm', $this->Permissions->CheckSitePermission($this->Auth->user('user_id'), Permission::$GameMaster));
        $this->set('isAjax', $this->request->is('ajax'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        $stunt = $this->Stunts->newEntity();
        if($this->request->is('get')) {
            $stunt->stunt_name = $this->request->getQuery('name');
        }

        if ($this->request->is('post')) {
            if (strtolower($this->request->getData('action')) == 'cancel') {
                $this->redirect(['action' => 'index']);
                return null;
            }
            $stunt = $this->Stunts->patchEntity($stunt, $this->request->getData());
            $stunt->created_by_id = $stunt->updated_by_id = $this->Auth->user('user_id');

            if ($this->Stunts->save($stunt)) {
                if($this->request->is('ajax')) {
                    $result = $stunt->toArray();
                    $result['result'] = 'ok';
                }
                else {
                    $this->Flash->set(__('The stunt has been saved'));
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                if($this->request->is('ajax')) {
                    $result = array (
                        'result' => 'error',
                        'message' => $stunt->getErrors()
                    );
                }
                else {
                    $this->Flash->set(__('The stunt could not be saved. Please, try again.'));
                }
            }
            // todo: EWWWW!!!
            if($this->request->is('ajax')) {
                header('content-type: application/json');
                echo json_encode($result);
                die();
            }
        }
        $skills = $this->Stunts->Skills->find('list', ['limit' => 100]);
        $isAjax = $this->request->is('ajax');
        $showAdmin = $this->Permissions->CheckSitePermission($this->Auth->user('user_id'), Permission::$EditDatabase);
        $this->set(compact('skills', 'isAjax', 'showAdmin', 'stunt'));
    }

    /**
     * edit method
     *
     * @param string $id
     * @return \Cake\Http\Response|null
     */
    public function edit($id = null)
    {
        $stunt = $this->Stunts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if (strtolower($this->request->getData('action')) == 'cancel') {
                $this->redirect(['action' => 'index']);
                return null;
            }
            $stunt = $this->Stunts->patchEntity($stunt, $this->request->getData());
            $stunt->updated_by_id = $this->Auth->user('user_id');
            if ($this->Stunts->save($stunt)) {
                $this->Flash->success(__('The stunt has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stunt could not be saved. Please, try again.'));
        }

        $skills = $this->Stunts->Skills->find('list');
        $this->set(compact('skills', 'stunt'));
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
        $stunt = $this->Stunts->get($id);
        if ($this->Stunts->delete($stunt)) {
            $this->Flash->success(__('The stunt has been deleted.'));
        } else {
            $this->Flash->error(__('The stunt could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user = true)
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
