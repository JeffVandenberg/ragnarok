<?php

namespace App\Controller;

use App\Model\Entity\CharacterSkill;
use App\Model\Table\DiceRollsTable;
use Cake\Event\Event;
use Cake\Network\Exception\MethodNotAllowedException;
use Cake\ORM\TableRegistry;

/**
 * DiceRolls Controller
 *
 * @property DiceRollsTable $DiceRolls
 * @property mixed RagnarokPermissions
 */
class DiceRollsController extends AppController
{
    /**
     * @param Event $event
     * @return \Cake\Http\Response|null|void
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->deny();
        $this->Auth->allow(array('index', 'view'));
    }

    /**
     * @param null $characterId
     */
    public function character($characterId = null)
    {
        $character = $this->DiceRolls->Characters->get($characterId, ['contain' => false]);

        if (!$this->validateUserCharacter($character)) {
            $this->Flash->set('You are not authorized for that character dice roller.');
            $this->redirect(array('controller' => 'diceRolls', 'action' => '/'));
        }

        $skills = TableRegistry::get('Skills')->find('list')->cache('skill_list');


        $query = $this->DiceRolls->find()
            ->contain([
                'Characters' => [
                    'fields' => ['character_name']
                ],
                'Skills' => [
                    'fields' => ['skill_name']
                ],
                'CreatedBy' => [
                    'fields' => ['username']
                ]
            ])
            ->where([
                'DiceRolls.is_official' => 1
            ]);
        $diceRolls = $this->Paginator->paginate(
            $query,
            [
                'limit' => 50,
                'order' => [
                    'created' => 'desc'
                ]
            ]
        );

        $isAjax = $this->request->is('ajax');
        $this->set(compact('characterSkills', 'character', 'skills', 'diceRolls', 'isAjax'));
    }

    /**
     *
     */
    public function rollDiceCharacter()
    {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException(__('Unable to Perform Request'));
        }
        $character = $this->DiceRolls->Characters->get($this->request->getData('character_id'));

        if ($character->current_fate < $this->request->getData('fate_spent')) {
            $data = array(
                'result' => 'error',
                'message' => 'Not enough fate.',
                'currentFate' => $character->current_fate
            );
        } elseif ($this->request->getData('fate_spent') < 0) {
            $data = array(
                'result' => 'error',
                'message' => 'Negative Fate spend is not allowed',
                'currentFate' => $character->current_fate
            );
        } elseif (!($this->Auth->user('user_id') > 1)) {
            $data = array(
                'result' => 'error',
                'message' => 'Please log in'
            );
        } else {
            if ($this->request->getData('fate_spent') > 0) {
                $character->current_fate -= $this->request->getData('fate_spent');
                $this->DiceRolls->Characters->save($character);
            }

            $total = 0;
            $rolls = array();
            for ($i = 0; $i < 4; $i++) {
                $roll = mt_rand(0, 2) - 1;
                $total += $roll;
                $rolls[] = $roll;
            }

            $characterSkillsTable = TableRegistry::get('CharacterSkills');

            $skillLevel = 0;
            $characterSkill = $characterSkillsTable->find('all', array(
                'conditions' => array(
                    'CharacterSkills.character_id' => $this->request->getData('character_id'),
                    'CharacterSkills.skill_id' => $this->request->getData('skill_id')
                ),
                'contain' => false
            ))->first();

            if ($characterSkill) {
                /* @var CharacterSkill $characterSkill */
                $skillLevel = $characterSkill->skill_level;
            }

            $dieRoll = $this->DiceRolls->newEntity($this->request->getData());
            $dieRoll->roll_total = $total;
            $dieRoll->skill_level = $skillLevel;
            $dieRoll->created_by_id = $this->Auth->user('user_id');
            $dieRoll->is_official = 1;

            if ($this->DiceRolls->save($dieRoll)) {
                $data = array(
                    'result' => 'success',
                    'rolls' => $rolls,
                    'currentFate' => $character->current_fate
                );
            } else {
                $data = array(
                    'result' => 'error',
                    'message' => 'Unable to save roll.',
                    'errors' => $dieRoll->getErrors(),
                    'currentFate' => $character->current_fate
                );
            }
        }
        $this->set(compact('data'));
        $this->set('_serialize', array('data'));
    }

    /**
     *
     */
    public function scene()
    {
        $skills = TableRegistry::get('Skills')->find('list')->cache('skill_list');

        $query = $this->DiceRolls->find()
            ->select([
                'DiceRolls.id',
                'DiceRolls.action_note',
                'DiceRolls.skill_level',
                'DiceRolls.roll_total',
                'DiceRolls.modifier',
                'DiceRolls.modifier',
                'Skills.skill_name',
                'Characters.character_name',
            ])
            ->contain([
                'Characters' => [
                    'fields' => ['character_name']
                ],
                'Skills' => [
                    'fields' => ['skill_name']
                ],
                'CreatedBy' => [
                    'fields' => ['username']
                ]
            ])
            ->where([
                'DiceRolls.is_official' => 1
            ]);
        $diceRolls = $this->Paginator->paginate(
            $query,
            [
                'limit' => 50,
                'order' => [
                    'created' => 'desc'
                ]
            ]
        );

        $isAjax = $this->request->is('ajax');
        $this->set(compact('skills', 'diceRolls', 'isAjax'));

    }

    /**
     *
     */
    public function rollDiceScene()
    {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException(__('Unable to Perform Request'));
        } elseif ($this->request->getData('fate_spent') < 0) {
            $data = array(
                'result' => 'error',
                'message' => 'Negative Fate spend is not allowed',
            );
        } elseif ($this->Auth->user('user_id') == 1) {
            $data = array(
                'result' => 'error',
                'message' => 'Please log in'
            );
        } else {
            $total = 0;
            $rolls = array();
            for ($i = 0; $i < 4; $i++) {
                $roll = mt_rand(0, 2) - 1;
                $total += $roll;
                $rolls[] = $roll;
            }

            $diceroll = $this->DiceRolls->newEntity($this->request->getData());
            $diceroll->roll_total = $total;
            $diceroll->created_by_id = $this->Auth->user('user_id');
            $diceroll->is_official = 1;

            if ($this->DiceRolls->save($diceroll)) {
                $data = array(
                    'result' => 'success',
                    'rolls' => $rolls
                );
            } else {
                $data = array(
                    'result' => 'error',
                    'message' => 'Unable to save roll.',
                    'errors' => $this->DiceRolls->validationErrors
                );
            }
        }
        $this->set(compact('data'));
        $this->set('_serialize', array('data'));
    }

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->DiceRolls->recursive = 0;
        $this->set('diceRolls', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        $diceRoll = $this->DiceRolls->get($id, [
            'contain' => [
                'Characters' => [
                    'fields' => ['character_name']
                ],
                'CreatedBy' => [
                    'fields' => ['username']
                ],
                'Skills' => [
                    'fields' => ['skill_name']
                ]
            ]
        ]);
        $this->set('diceRoll', $diceRoll);
    }

    /**
     * @param null $user
     * @return bool
     */
    public function isAuthorized($user = null)
    {
        switch ($this->request->getParam('action')) {
            case 'index':
            case 'character':
            case 'scene':
            case 'rollDiceScene':
            case 'rollDiceCharacter':
                return $this->Auth->user('user_id') != 1;
                break;
        }
        return false;
    }
}
