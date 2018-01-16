<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Powers Controller
 *
 * @property \App\Model\Table\PowersTable $Powers
 *
 * @method \App\Model\Entity\Power[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AAPowersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CreatedBies', 'UpdatedBies']
        ];
        $powers = $this->paginate($this->Powers);

        $this->set(compact('powers'));
    }

    /**
     * View method
     *
     * @param string|null $id Power id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $power = $this->Powers->get($id, [
            'contain' => ['CreatedBies', 'UpdatedBies', 'CharacterPowers', 'TemplatePowers']
        ]);

        $this->set('power', $power);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $power = $this->Powers->newEntity();
        if ($this->request->is('post')) {
            $power = $this->Powers->patchEntity($power, $this->request->getData());
            if ($this->Powers->save($power)) {
                $this->Flash->success(__('The power has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The power could not be saved. Please, try again.'));
        }
        $createdBies = $this->Powers->CreatedBies->find('list', ['limit' => 200]);
        $updatedBies = $this->Powers->UpdatedBies->find('list', ['limit' => 200]);
        $this->set(compact('power', 'createdBies', 'updatedBies'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Power id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $power = $this->Powers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $power = $this->Powers->patchEntity($power, $this->request->getData());
            if ($this->Powers->save($power)) {
                $this->Flash->success(__('The power has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The power could not be saved. Please, try again.'));
        }
        $createdBies = $this->Powers->CreatedBies->find('list', ['limit' => 200]);
        $updatedBies = $this->Powers->UpdatedBies->find('list', ['limit' => 200]);
        $this->set(compact('power', 'createdBies', 'updatedBies'));
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
}
