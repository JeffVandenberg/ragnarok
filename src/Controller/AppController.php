<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use App\Model\Entity\Character;
use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public $components = array(
        'RequestHandler',
        'Paginator',
        'Auth' => [
            'authenticate' => ['Phpbb'],
            'authorize' => ['Controller'],
            'loginAction' => '/forum/ucp.php?mode=login',
            'unauthorizedRedirect' => '/forum/ucp.php?mode=login'
        ],
        'Permissions',
        'Menu',
        'Flash'
    );

    public $helpers = array(
        'Html',
        'Form',
        'MainMenu',
        'Shrink.Shrink' => [
            'debugLevel' => 1
        ]
    );

    public function beforeFilter(Event $event)
    {
        global $userdata;
        if ($userdata['user_id'] != $this->Auth->user('user_id')) {
            $this->Auth->logout();
            $this->Auth->setUser($userdata);
        }
        $this->Menu->InitializeMenu();
        $this->Auth->deny();
    }

    public function beforeRender(Event $event)
    {
        $this->viewBuilder()->setLayout(($this->request->is("ajax")) ? "ajax" : "default");
        if ($this->request->getQuery('foundation', 0)) {
            $this->viewBuilder()->setLayout('foundation');
        }
        $this->set('menu', $this->Menu->GetMenu());
        $this->set('currentUser', $this->Auth->user());
        $this->set('serverTime', (microtime(true) + date('Z')) * 1000);
        $this->set('buildNumber', file_get_contents(ROOT . '/build_number'));
    }

    public function isAuthorized($user = null)
    {
        if ($user == null) {
            return false;
        }

        return true;
    }

    /**
     * @param Character $character
     * @return bool
     */
    public function validateUserCharacter(Character $character)
    {
        return ($character->created_by_id = $this->Auth->user('user_id'));
    }


}
