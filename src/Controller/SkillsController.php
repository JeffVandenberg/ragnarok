<?php
namespace App\Controller;

use App\Controller\Component\PermissionsComponent;
use App\Model\Entity\Permission;
use App\Model\Entity\Skill;
use App\Model\Table\SkillsTable;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

/**
 * Skills Controller
 *
 * @property SkillsTable $Skills
 * @property PermissionsComponent $Permissions
 */
class SkillsController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index', 'view', 'getList']);
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
                'Skills.skill_name' => 'asc'
            ],
            'contain' => false
        ];

        $skills = $this->paginate($this->Skills);

        $this->set(compact('skills'));
    }

    /**
     * Retrieve a JSON list of skills from the database.
     */
    public function getList()
    {
        $data = $this->Skills->query()
            ->where([
                'Skills.skill_name like' => $this->request->getQuery('term') . '%'
            ])
            ->contain(false)
            ->order([
                'skill_name'
            ])
            ->toArray();

        $this->set(compact('data'));
        $this->set('_serialize', ['data']);

        // TODO: refactor to not need to do this
        $data = array_map(function(Skill $i) {
            return [
                'value' => $i->id,
                'label' => $i->skill_name
            ];
        }, $data);
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
        $skill = $this->Skills->get($id, [
            'contain' => [
                'Stunts' => [
                    'sort' => [
                        'Stunts.stunt_name'
                    ]
                ]
            ]
        ]);

        $this->set(compact('skill'));
    }

    /**
     * @return \Cake\Http\Response|null
     */
    public function add()
    {
        $skill = $this->Skills->newEntity();
        if ($this->request->is('post')) {
            if (strtolower($this->request->getData('action')) == 'cancel') {
                $this->redirect(['action' => 'index']);
                return null;
            }
            $skill = $this->Skills->patchEntity($skill, $this->request->getData());
            if ($this->Skills->save($skill)) {
                $this->Flash->success(__('The skill has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The skill could not be saved. Please, try again.'));
        }
        $this->set(compact('skill'));
    }

    /**
     * edit method
     *
     * @param string $id
     * @return \Cake\Http\Response|null
     */
    public function edit($id = null)
    {
        $skill = $this->Skills->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if (strtolower($this->request->getData('action')) == 'cancel') {
                $this->redirect(['action' => 'index']);
                return null;
            }
            $skill = $this->Skills->patchEntity($skill, $this->request->getData());
            if ($this->Skills->save($skill)) {
                $this->Flash->success(__('The skill has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The skill could not be saved. Please, try again.'));
        }

        $this->set(compact('skill'));
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
        $power = $this->Skills->get($id);
        if ($this->Skills->delete($power)) {
            $this->Flash->success(__('The power has been deleted.'));
        } else {
            $this->Flash->error(__('The power could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
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
