<?php
App::uses('AppController', 'Controller');
/**
 * DiceRolls Controller
 *
 * @property DiceRoll $DiceRoll
 * @property mixed RagnarokPermissions
 */
class DiceRollsController extends AppController
{

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->deny();
        $this->Auth->allow(array('index', 'view'));
        $this->Paginator->settings = array(
            'DiceRoll' => array(
                'limit' => 10,
                'order' => array(
                    'DiceRoll.created' => 'desc'
                )
            )
        );
    }

    public function character($characterId = null)
    {
        if (!$this->DiceRoll->Character->exists($characterId))
        {
            throw new NotFoundException(__('Invalid character interface.'));
        }

        if(!$this->validateUserCharacter($characterId))
        {
            $this->Session->setFlash('You are not authorized for that character dice roller.');
            $this->redirect(array('controller' => 'diceRolls', 'action' => '/'));
        }

        $skills = $this->DiceRoll->Skill->find('list');

        $character = $this->DiceRoll->Character->find('first', array(
            'conditions' => array(
                'Character.' . $this->DiceRoll->Character->primaryKey => $characterId
            ),
            'contain' => false
        ));
        $diceRolls = $this->Paginator->paginate(
            'DiceRoll',
            array(
                'DiceRoll.is_official' => 1
            )
        );

        $isAjax = $this->request->is('ajax');
        $this->set(compact('characterSkills', 'character', 'skills', 'diceRolls', 'isAjax'));
    }

    public function rollDiceCharacter()
    {
        if (!$this->request->is('post'))
        {
            throw new MethodNotAllowedException(__('Unable to Perform Request'));
        }
        $character = $this->DiceRoll->Character->find('first', array(
            'conditions' => array(
                'Character.id' => $this->request->data['DiceRoll']['character_id']
            )
        ));

        if ($character['Character']['current_fate'] < $this->request->data['DiceRoll']['fate_spent'])
        {
            $data = array(
                'result' => 'error',
                'message' => 'Not enough fate.',
                'currentFate' => $character['Character']['current_fate']
            );
        }
        elseif($this->request->data['DiceRoll']['fate_spent'] < 0)
        {
            $data = array(
                'result' => 'error',
                'message' => 'Negative Fate spend is not allowed',
                'currentFate' => $character['Character']['current_fate']
            );
        }
        elseif(!($this->Auth->user('user_id') > 1))
        {
            $data = array(
                'result' => 'error',
                'message' => 'Please log in'
            );
        }
        else
        {
            if($this->request->data['DiceRoll']['fate_spent'] > 0)
            {
                $character['Character']['current_fate'] -= $this->request->data['DiceRoll']['fate_spent'];
                $this->DiceRoll->Character->save($character);
            }
            $total = 0;
            $rolls = array();
            for ($i = 0; $i < 4; $i++)
            {
                $roll = mt_rand(0, 2) - 1;
                $total += $roll;
                $rolls[] = $roll;
            }

            App::uses('CharacterSkill', 'Model');
            $characterSkillRepository = new CharacterSkill();
            $skillLevel = 0;
            $characterSkill = $characterSkillRepository->find('first', array(
                'conditions' => array(
                    'CharacterSkill.character_id' => $this->request->data['DiceRoll']['character_id'],
                    'CharacterSkill.skill_id' => $this->request->data['DiceRoll']['skill_id'],
                ),
                'contain' => false
            ));
            if(count($characterSkill) > 0)
            {
                $skillLevel = $characterSkill['CharacterSkill']['skill_level'];
            }


            $this->request->data['DiceRoll']['roll_total'] = $total;
            $this->request->data['DiceRoll']['skill_level'] = $skillLevel;
            $this->request->data['DiceRoll']['created_by_id'] = $this->Auth->user('user_id');
            $this->request->data['DiceRoll']['is_official'] = 1;

            if ($this->DiceRoll->save($this->request->data))
            {
                $data = array(
                    'result' => 'success',
                    'rolls' => $rolls,
                    'currentFate' => $character['Character']['current_fate']
                );
            }
            else
            {
                $data = array(
                    'result' => 'error',
                    'message' => 'Unable to save roll.',
                    'errors' => $this->DiceRoll->validationErrors,
                    'currentFate' => $character['Character']['current_fate']
                );
            }
        }
        $this->viewClass = 'Json';
        $this->set(compact('data'));
        $this->set('_serialize', array('data'));
    }

    public function scene()
    {
        $skills = $this->DiceRoll->Skill->find('list');

        $diceRolls = $this->Paginator->paginate(
            'DiceRoll',
            array(
                'DiceRoll.is_official' => 1
            )
        );

        $isAjax = $this->request->is('ajax');
        $this->set(compact('skills', 'diceRolls', 'isAjax'));

    }

    public function rollDiceScene()
    {
        if (!$this->request->is('post'))
        {
            throw new MethodNotAllowedException(__('Unable to Perform Request'));
        }

        elseif($this->request->data['DiceRoll']['fate_spent'] < 0)
        {
            $data = array(
                'result' => 'error',
                'message' => 'Negative Fate spend is not allowed',
            );
        }
        elseif(!($this->Auth->user('user_id') > 1))
        {
            $data = array(
                'result' => 'error',
                'message' => 'Please log in'
            );
        }
        else
        {
            $total = 0;
            $rolls = array();
            for ($i = 0; $i < 4; $i++)
            {
                $roll = mt_rand(0, 2) - 1;
                $total += $roll;
                $rolls[] = $roll;
            }

            $this->request->data['DiceRoll']['roll_total'] = $total;
            $this->request->data['DiceRoll']['created_by_id'] = $this->Auth->user('user_id');
            $this->request->data['DiceRoll']['is_official'] = 1;

            if ($this->DiceRoll->save($this->request->data))
            {
                $data = array(
                    'result' => 'success',
                    'rolls' => $rolls
                );
            }
            else
            {
                $data = array(
                    'result' => 'error',
                    'message' => 'Unable to save roll.',
                    'errors' => $this->DiceRoll->validationErrors
                );
            }
        }
        $this->viewClass = 'Json';
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
        $this->DiceRoll->recursive = 0;
        $this->set('diceRolls', $this->Paginator->paginate());
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
        if (!$this->DiceRoll->exists($id))
        {
            throw new NotFoundException(__('Invalid dice roll'));
        }
        $options = array('conditions' => array('DiceRoll.' . $this->DiceRoll->primaryKey => $id));
        $this->set('diceRoll', $this->DiceRoll->find('first', $options));
    }

    public function isAuthorized($user = null)
    {
        switch ($this->request->params['action']) {
            case 'index':
            case 'character':
            case 'scene':
            case 'rollDiceScene':
            case 'rollDiceCharacter':
                return $this->Auth->loggedIn();
                break;
        }
        return false;
    }
}
