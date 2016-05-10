<?php
App::uses('AppController', 'Controller');

/**
 * Characters Controller
 *
 * @property Character $Character
 * @property Skill $Skill
 * @property RagnarokPermissionsComponent RagnarokPermissions
 * @property ConfigComponent Config
 */
class CharactersController extends AppController
{
    public $uses = array(
        'Character',
        'Skill'
    );

    public $components = array(
        'Config'
    );

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->deny();
        $this->Auth->allow(array('publicView'));

        $this->Paginator->settings = array(
            'Character' => array(
                'limit' => 20,
                'order' => 'Character.character_name'
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
                'Character.created_by_id' => $this->Auth->user('user_id')
            )
        );
        $this->set('characters', $characters);
    }

    /**
     * cast of sanctioned characters
     *
     * @return void
     */
    public function cast()
    {
        App::uses('CharacterStatus', 'Model');
        $this->Character->recursive = 0;
        $this->Paginator->settings = array(
            'Character' => array(
                'limit' => 20,
                'contain' => array(
                    'Template',
                    'CreatedBy'
                ),
                'order' => 'Character.character_name'
            )
        );
        $characters = $this->Paginator->paginate(
            'Character',
            array(
                'Character.character_status_id' => CharacterStatus::Approved
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
        if(!$this->validateUserCharacter($id))
        {
            $this->Flash->set('You are not authorized to view that character.');
            $this->redirect(array('controller' => 'characters', 'action' => '/'));
        }
        $this->set('character', $this->Character->LoadCharacter($id));
    }

    /**
     * tools method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function tools($id = null)
    {
        if (!$this->Character->exists($id)) {
            throw new NotFoundException(__('Invalid character'));
        }
        if(!$this->validateUserCharacter($id))
        {
            $this->Flash->set('You are not authorized to view that character.');
            $this->redirect(array('controller' => 'characters', 'action' => '/'));
        }
        $this->set('character', $this->Character->LoadCharacter($id));
    }

    public function publicView($id = null)
    {
        if (!$this->Character->exists($id)) {
            throw new NotFoundException(__('Invalid character'));
        }
        $this->set('character', $this->Character->LoadCharacter($id));
    }

    public function gmView($characterId = null)
    {
        if($this->request->is('put') || $this->request->is('post') || $this->request->is('get'))
        {
            if(isset($this->request->data['Character']['id']))
            {
                $this->request->data['Character']['updated_by_id'] = $this->Auth->user('user_id');
                if(isset($this->request->data['CharacterGmNote']))
                {
                    $this->request->data['CharacterGmNote'][-1]['created_by_id'] = $this->Auth->user('user_id');
                }
                if ($this->Character->SaveCharacter($this->request->data)) {
                    $this->Flash->set(__('The character has been saved'));
                    $this->redirect(array('action' => 'gmView'));
                } else {
                    $this->Flash->set(__('The character could not be saved. Please, try again.'));
                }
            }
            if(isset($this->request->data['lookup_id']) || $characterId)
            {
                $characterId = (isset($this->request->data['lookup_id'])) ? $this->request->data['lookup_id'] : $characterId;
                $character = $this->Character->LoadCharacter($characterId);
                $this->request->data = $character;
            }
            $characterStatuses = $this->Character->CharacterStatus->find('list');
            $this->set('characterStatuses', $characterStatuses);
            $this->SetCharacterLists();
        }
    }

    /**
     * Retrieve a JSON list of powers from the database.
     */
    public function getList()
    {
        $characters = $this->Character->find(
            'list',
            array(
                'conditions' => array(
                    'Character.character_name like' => $this->request->query['term'] . '%'
                ),
                'contain' => false,
                'order' => 'character_name'
            )
        );

        $items = array();
        foreach($characters as $value => $label)
        {
            $output['value'] = $value;
            $output['label'] = $label;
            $items[] = $output;
        }
        echo json_encode($items);
        die();
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
            $this->request->data['Character']['created_by_id'] = $this->Auth->user('user_id');
            $this->request->data['Character']['updated_by_id'] = $this->Auth->user('user_id');
            $this->request->data['Character']['game_id'] = 1;
            $this->request->data['Character']['current_fate'] = $this->request->data['Character']['max_fate'];
            $this->request->data['Character']['character_status_id'] = 1;
            if ($this->Character->SaveCharacter($this->request->data)) {
                $this->Flash->set(__('The character has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                //debug($this->Character->validationErrors);
                $this->Flash->set(__('The character could not be saved. Please, try again.'));
            }
        }
        else {
            $character = array();
            $character['Character']['physical_stress_skill_id'] = Configure::read('character.PhysicalStressSkillId');
            $character['Character']['mental_stress_skill_id'] = Configure::read('character.MentalStressSkillId');
            $character['Character']['social_stress_skill_id'] = Configure::read('character.SocialStressSkillId');
            $character['Character']['hunger_stress_skill_id'] = Configure::read('character.HungerStressSkillId');
            $character['Character']['available_significant_milestones'] = 0;
            $character['Character']['available_major_milestones'] = 0;
            $character['Character']['power_level'] = $this->Config->Read('POWER_LEVEL');
            $character['Character']['skill_points'] = $this->Config->Read('SKILL_POINTS');
            $character['Character']['skill_level'] = $this->Config->Read('SKILL_POINTS');
            $this->request->data = $character;
        }

        $this->SetCharacterLists();
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
        if(!$this->validateUserCharacter($id))
        {
            $this->Flash->set('You are not authorized to edit that character.');
            $this->redirect(array('controller' => 'characters', 'action' => '/'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Character']['updated_by_id'] = $this->Auth->user('user_id');
            if ($this->Character->SaveCharacter($this->request->data)) {
                $this->Flash->set(__('The character has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->set(__('The character could not be saved. Please, try again.'));
            }
        } else {
            $character = $this->Character->LoadCharacter($id);
            App::uses('CharacterStatus', 'Model');
            if($character['Character']['character_status_id'] != CharacterStatus::NewCharacter) {
                $this->redirect(array('action' => 'editLimited', $id));
            }
            $this->request->data = $character;
        }

        $this->SetCharacterLists();
    }

    /**
     * edit sanctioned character method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function editLimited($id = null)
    {
        if (!$this->Character->exists($id)) {
            throw new NotFoundException(__('Invalid character'));
        }
        if(!$this->validateUserCharacter($id))
        {
            $this->Flash->set('You are not authorized to edit that character.');
            $this->redirect(array('controller' => 'characters', 'action' => '/'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Character']['updated_by_id'] = $this->Auth->user('user_id');
            if ($this->Character->SaveLimitedCharacter($this->request->data)) {
                $this->Flash->set(__('The character has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->set(__('The character could not be saved. Please, try again.'));
            }
        } else {
            $character = $this->Character->LoadLimitedCharacter($id);
            $this->request->data = $character;
        }

        $this->SetCharacterLists();
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
        if(!$this->validateUserCharacter($id))
        {
            $this->Flash->set('You are not authorized to delete that character.');
            $this->redirect(array('controller' => 'characters', 'action' => '/'));
        }
        if ($this->Character->delete()) {
            $this->Flash->set(__('Character deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Flash->set(__('Character was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function isAuthorized($user = null)
    {
        switch ($this->request->params['action']) {
            case 'index':
            case 'view':
            case 'tools':
            case 'edit':
            case 'editLimited':
            case 'delete':
            case 'add':
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

    /**
     * @return array
     */
    private function SetCharacterLists()
    {
        $skillSpreads = array(
            1 => '5/6/8',
            2 => '3/3/3/8',
            3 => '1/2/3/4/5',
            4 => '2/2/2/3/5'
        );
        $templates = $this->Character->Template->find('list');
        $skills = $this->Skill->find('list');
        $this->set(compact('templates', 'skillSpreads', 'skills'));
    }
}
