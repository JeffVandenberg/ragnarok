<?php

namespace App\Controller;

use App\Controller\Component\ConfigComponent;
use App\Controller\Component\PermissionsComponent;
use App\Model\Entity\CharacterStatus;
use App\Model\Entity\Permission;
use App\Model\Entity\Skill;
use App\Model\Table\CharactersTable;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use function compact;

/**
 * Characters Controller
 *
 * @property CharactersTable $Characters
 * @property Skill $Skill
 * @property PermissionsComponent $Permissions
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

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->deny();
        $this->Auth->allow([
            'publicView',
            'cast'
        ]);
    }

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $characters = $this->Characters
            ->find()
            ->contain([
                'CreatedBy' => [
                    'fields' => ['username']
                ],
                'UpdatedBy' => [
                    'fields' => ['username']
                ],
                'CharacterStatuses'
            ])
            ->where([
                'Characters.created_by_id' => $this->Auth->user("user_id")
            ])
            ->order([
                'Characters.character_name'
            ])
            ->toArray();
        $this->set('characters', $characters);
    }

    /**
     * cast of sanctioned characters
     *
     * @return void
     */
    public function cast()
    {
        $query = $this->Characters
            ->find()
            ->select([
                'Characters.id',
                'Characters.character_name',
            ])
            ->contain([
                'Templates' => [
                    'fields' => ['template_name']
                ],
                'CreatedBy' => [
                    'fields' => ['username']
                ]
            ])
            ->where([
                'Characters.character_status_id' => CharacterStatus::Approved
            ]);

        $this->set('characters', $this->paginate($query, [
            'limit' => 20,
            'order' => [
                'Characters.character_name'
            ],
            'sortWhitelist' => [
                'Characters.character_name',
                'character_name',
                'Templates.template_name',
                'CreatedBy.username'
            ]
        ]));
    }

    /**
     * view method
     *
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        $character = $this->Characters->loadCharacter($id);
        if (!$this->validateUserCharacter($character)) {
            $this->Flash->set('You are not authorized to view that character.');
            $this->redirect(array('controller' => 'characters', 'action' => '/'));
        }
        $options = [
            'max_skill_level' => 5,
            'edit_full' => false,
            'edit_limited' => false,
            'is_new' => false
        ];
        $this->set(compact('character', 'options'));
    }

    /**
     * tools method
     *
     * @param string $id
     * @return void
     */
    public function tools($id = null)
    {
        $character = $this->Characters->loadCharacter($id);
        if (!$this->validateUserCharacter($character)) {
            $this->Flash->set('You are not authorized to view that character.');
            $this->redirect(array('controller' => 'characters', 'action' => '/'));
        }
        $this->set('character', $character);
    }

    public function publicView($id = null)
    {
        $this->set('character', $this->Characters->LoadCharacter($id));
    }

    public function gmView($characterId = null)
    {
        $characterId =
            $this->request->getData('id', $this->request->getData('lookup_id', $characterId));
        if($characterId) {
            $character = $this->Characters->loadCharacter($characterId);

            if ($this->request->is(['post', 'put']) && $this->request->getData('id')) {
                $character = $this->Characters->patchEntity($character, $this->request->getData());
                $character->character_gm_notes[0]->created_by_id
                    = $character->updated_by_id
                    = $this->Auth->user('user_id');

                if ($this->Characters->saveCharacter($character)) {
                    $this->Flash->set(__($character->character_name . ' has been saved'));
                    $this->redirect(array('action' => 'gmView'));
                } else {
                    debug($character->getErrors());
                    $this->Flash->set(__('The character could not be saved. Please, try again.'));
                }
            }

            $options = [
                'skill_points' => $this->Config->Read('SKILL_POINTS'),
                'max_skill_level' => 5,
                'skills' => TableRegistry::get('Skills')->find('list')->cache('skill_list'),
                'edit_full' => true,
                'edit_gm' => true,
                'is_new' => false,
            ];
            $characterStatuses = TableRegistry::get('CharacterStatuses')->find('list')->cache('character_status_list');
            $this->set(compact('character', 'skillPoints', 'options', 'characterStatuses'));
            $this->SetCharacterLists();
        }
    }

    /**
     * Retrieve a JSON list of powers from the database.
     */
    public function getList()
    {
        $characters = $this->Characters->find(
            'list',
            array(
                'conditions' => array(
                    'Characters.character_name like' => $this->request->getQuery('term') . '%'
                ),
                'contain' => false,
                'order' => 'character_name'
            )
        );

        $items = array();
        foreach ($characters as $value => $label) {
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
        $character = $this->Characters->newEntity();
        if ($this->request->is('post')) {
            $character = $this->Characters->newEntity();
            $this->Characters->patchEntity($character, $this->request->getData());
            $character->game_id = 1;
            $character->created_by_id = $character->updated_by_id = $this->Auth->user('user_id');
            $character->current_fate = $character->max_fate;
            $character->character_status_id = CharacterStatus::New;

            if ($this->Characters->saveCharacter($character)) {
                $this->Flash->set(__('The character has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->set(__('The character could not be saved. Please, try again.'));
            }
        } else {
            $character->physical_stress_skill_id = Configure::read('character.physical_stress_skill_id');
            $character->mental_stress_skill_id = Configure::read('character.mental_stress_skill_id');
            $character->social_stress_skill_id = Configure::read('character.social_stress_skill_id');
            $character->hunger_stress_skill_id = Configure::read('character.hunger_stress_skill_id');
            $character->available_significant_milestones = 0;
            $character->available_major_milestones = 0;
            $character->power_level = $this->Config->Read('POWER_LEVEL');
            $character->skill_level = $this->Config->Read('SKILL_POINTS');
            $character->character_aspects = array_map(function($i) {
                $aspect = $this->Characters->CharacterAspects->newEntity();
                $aspect->aspect_type_id = $i;
                return $aspect;
            }, range(1, 7));

        }
        $skillPoints = $this->Config->Read('SKILL_POINTS');
        $options = [
            'skill_points' => $skillPoints,
            'max_skill_level' => 5,
            'edit_full' => true,
            'is_new' => true
        ];
        $this->set(compact('character', 'skillPoints', 'options'));

        $this->SetCharacterLists();
    }

    /**
     * edit method
     *
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        $character = $this->Characters->loadCharacter($id);
        if (!$this->validateUserCharacter($character)) {
            $this->Flash->set('You are not authorized to edit that character.');
            $this->redirect(array('controller' => 'characters', 'action' => '/'));
        }
        if ($this->request->is(['post', 'put'])) {
            $character = $this->Characters->patchEntity($character, $this->request->getData());
            $character->updated_by_id = $this->Auth->user('user_id');
            if ($this->Characters->saveCharacter($character)) {
                $this->Flash->set(__('The character has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->set(__('The character could not be saved. Please, try again.'));
            }
        } else {
            if ($character->character_status_id != CharacterStatus::New) {
                $this->redirect(array('action' => 'editLimited', $id));
            }
        }

        $skills = TableRegistry::get('Skills')->find('list')->cache('skill_list');
        $options = [
            'skill_points' => $this->Config->Read('SKILL_POINTS'),
            'skills' => $skills,
            'max_skill_level' => 5,
            'edit_full' => true,
            'is_new' => false
        ];
        $this->set(compact('character', 'skillPoints', 'options'));

        $this->SetCharacterLists();
    }

    /**
     * edit sanctioned character method
     *
     * @param string $id
     * @return void
     */
    public function editLimited($id = null)
    {
        $character = $this->Characters->loadCharacter($id);
        if (!$this->validateUserCharacter($character)) {
            $this->Flash->set('You are not authorized to edit that character.');
            $this->redirect(array('controller' => 'characters', 'action' => '/'));
        }
        if ($this->request->is(['post', 'put'])) {
            $character = $this->Characters->patchEntity($character, $this->request->getData());
            $character->updated_by_id = $this->Auth->user('user_id');
            if ($this->Characters->saveCharacter($character)) {
                $this->Flash->set(__('The character has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->set(__('The character could not be saved. Please, try again.'));
            }
        } else {
            if ($character->character_status_id == CharacterStatus::New) {
                $this->redirect(array('action' => 'edit', $id));
            }
        }

        $options = [
            'skill_points' => $this->Config->Read('SKILL_POINTS'),
            'max_skill_level' => 5,
            'edit_full' => false,
            'edit_limited' => true,
            'is_new' => false
        ];
        $this->set(compact('character', 'skillPoints', 'options'));

        $this->SetCharacterLists();
    }

    public function isAuthorized($user = null)
    {
        switch ($this->request->getParam('action')) {
            case 'index':
            case 'view':
            case 'tools':
            case 'edit':
            case 'editLimited':
            case 'delete':
            case 'add':
                return $this->Auth->user('user_id') != 1;
                break;
            case 'getList':
            case 'gmView':
                return $this->Permissions->CheckSitePermission($this->Auth->user('user_id'), Permission::$GameMaster);
                break;
            case 'cast':
                return true;
                break;
        }
        return false;
    }

    /**
     * @return void
     */
    private function SetCharacterLists()
    {
        $skills = TableRegistry::get('Skills')
            ->find('list')
            ->cache('skill_list');
        $templates = $this->Characters->Templates->find('list')->cache('template_list');
        $this->set(compact('templates', 'skills'));
    }
}
