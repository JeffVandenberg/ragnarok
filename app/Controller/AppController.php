<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');
App::uses('Permission', 'Model');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package        app.Controller
 * @property MenuComponent Menu
 * @link        http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public $components = array(
        'DebugKit.Toolbar',
        'Session',
        'RequestHandler',
        'Paginator',
        'Auth',
        'RagnarokPermissions',
        'Menu'
    );

    public $helpers = array(
        'Html',
        'Session',
        'Form',
        'Login',
        'Js' => array(
            'Jquery'
        ),
        'MainMenu'
    );

    public function beforeFilter()
    {
        $this->Auth->authenticate = array('Ragnarok');
        $this->Auth->authorize    = array('Controller');
        if (!$this->Auth->user()) {
            $this->Auth->login();
        }
        $this->Menu->InitializeMenu();
        $this->Auth->deny();
    }

    public function beforeRender()
    {
        $this->layout = ($this->request->is("ajax")) ? "ajax" : "default";
        if(isset($this->request->query['foundation'])) {
            $this->layout = 'foundation';
        }
        $this->set('menu', $this->Menu->GetMenu());
        $this->set('currentUser', $this->Auth->user());
    }

    public function isAuthorized($user = null)
    {
        if ($user == null) {
            return false;
        }

        return true;
    }

    /**
     * @param $characterId
     * @return array
     */
    public function validateUserCharacter($characterId)
    {
        App::uses('Character', 'Model');
        $characterRepository = new Character();
        $character           = $characterRepository->find('first', array(
            'conditions' => array(
                'Character.id'            => $characterId,
                'Character.created_by_id' => $this->Auth->user('user_id')
            ),
            'contain'    => false
        ));

        return (count($character) > 0);
    }


}
