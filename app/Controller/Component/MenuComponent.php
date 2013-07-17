<?php
/**
 * Created by JetBrains PhpStorm.
 * User: JeffVandenberg
 * Date: 5/26/13
 * Time: 10:37 AM
 * To change this template use File | Settings | File Templates.
 */

App::uses('Component', 'Controller');

/**
 * @property AuthComponent Auth
 * @property RagnarokPermissionsComponent RagnarokPermissions
 * @property SessionComponent Session
 */
class MenuComponent extends Component {
    public $components = array(
        'Auth',
        'RagnarokPermissions',
        'Session'
    );

    private $menu = array();

    public function InitializeMenu()
    {
        $this->menu = array(
            'Home' => array(
                'link' => '/',
                'target' => '_top'
            ),
            'Forum' => array(
                'link' => '/',
                'append' => 'forum'
            ),
            'Wiki' => array(
            ),
            'Database' => array(
                'menu' => array(
                    'Powers' => array(
                        'controller' => 'powers',
                        'action' => 'index'
                    ),
                    'Skills' => array(
                        'controller' => 'skills',
                        'action' => 'index'
                    ),
                    'Stunts' => array(
                        'controller' => 'stunts',
                        'action' => 'index'
                    ),
                    'Templates' => array(
                        'controller' => 'templates',
                        'action' => 'index'
                    )
                )
            ),
            'Stories' => array(

            ),
            'Characters' => array(

            ),
            'Tools' => array(

            ),

        );

        if($this->Auth->loggedIn())
        {
            $this->menu['Characters'] = array(
                'link' => array(
                    'controller' => 'characters',
                    'action' => 'index'
                )
            );
        }

        if($this->RagnarokPermissions->CheckPermission($this->Session->read('user_id'), Permission::$ViewUsers))
        {
            $this->menu['Tools']['menu']['User management'] = array(
                'controller' => 'users',
                'action' => 'index'
            );
        }

        if($this->RagnarokPermissions->CheckPermission($this->Session->read('user_id'), Permission::$GameMaster))
        {
            $this->menu['Tools']['menu']['GM Tools'] = array(
                'controller' => 'gamemaster',
                'action' => 'index'
            );
        }
    }

    public function GetMenu()
    {
        return $this->menu;
    }


}