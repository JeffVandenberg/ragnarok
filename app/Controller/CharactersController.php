<?php
App::uses('AppController', 'Controller');
/**
 * Characters Controller
 *
 * @property Character $Character
 * @property Skill $Skill
 */
class CharactersController extends AppController
{
    public $uses = array(
        'Character',
        'Skill'
    );

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Paginator->settings = array(
            'Character' => array(
                'limit' => 1
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
        $this->Character->recursive = 0;
        $characters = $this->Paginator->paginate(
            'Character',
            array(
                'Character.created_by_id' => $this->Session->read('user_id')
            )
        );
        $this->set('characters', $characters);
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
        if (!$this->Character->exists($id)) {
            throw new NotFoundException(__('Invalid character'));
        }
        $options = array('conditions' => array('Character.' . $this->Character->primaryKey => $id));
        $this->set('character', $this->Character->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Character->create();
            $this->request->data['Character']['created_by_id'] = $this->Session->read('user_id');
            $this->request->data['Character']['updated_by_id'] = $this->Session->read('user_id');
            $this->request->data['Character']['game_id'] = 1;
            $this->request->data['Character']['current_fate'] = $this->request->data['Character']['max_fate'];
            $this->request->data['Character']['character_status_id'] = 1;

            $data = array();
            $data['Character'] = $this->request->data['Character'];
            $data['Character']['character_name'] = 'A Much Longer Name';
            $data['CharacterSkill'] = $this->request->data['CharacterSkill'];
            foreach($data['CharacterSkill'] as $id => $skill) {
                if($skill['skill_id'] == 0) {
                    unset($data['CharacterSkill'][$id]);
                }
            }
            //$this->Character->saveAll($data);
            //debug($this->Character->validationErrors);
            debug($this->request->data);

            die();
            if ($this->Character->save($this->request->data)) {
                $this->Session->setFlash(__('The character has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The character could not be saved. Please, try again.'));
            }
        }
        $skillSpreads = array(
            1 => '5/5/5',
            2 => '2/3/4/5',
            3 => '3/3/3/3',
            4 => '2/2/2/2/2'
        );
        $templates = $this->Character->Template->find('list');
        $skills = $this->Skill->find('list');
        $character = array();
        $character['Character']['physical_stress_skill_id'] = Configure::read('character.PhysicalStressSkillId');
        $character['Character']['mental_stress_skill_id'] = Configure::read('character.MentalStressSkillId');
        $character['Character']['social_stress_skill_id'] = Configure::read('character.SocialStressSkillId');
        $character['Character']['hunger_stress_skill_id'] = Configure::read('character.HungerStressSkillId');
        $this->request->data = $character;

        $this->set(compact('templates', 'skillSpreads', 'skills'));
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
        if (!$this->Character->exists($id)) {
            throw new NotFoundException(__('Invalid character'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Character->save($this->request->data)) {
                $this->Session->setFlash(__('The character has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The character could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Character->LoadCharacter($id);
        }
        $games = $this->Character->Game->find('list');
        $templates = $this->Character->Template->find('list');
        $skillSpreads = array(
            1 => '5/5/5',
            2 => '2/3/4/5',
            3 => '3/3/3/3',
            4 => '2/2/2/2/2'
        );
        $templates[-1] = 'Custom';
        $skills = $this->Skill->find('list');
        $this->set(compact('games', 'characterStatuses', 'createdBies', 'updatedBies', 'templates', 'skillSpreads', 'skills'));
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
        $this->Character->id = $id;
        if (!$this->Character->exists()) {
            throw new NotFoundException(__('Invalid character'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Character->delete()) {
            $this->Session->setFlash(__('Character deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Character was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function isAuthorized($user = null)
    {
        return true;
    }
}
