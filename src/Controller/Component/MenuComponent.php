<?php
/**
 * Created by JetBrains PhpStorm.
 * User: JeffVandenberg
 * Date: 5/26/13
 * Time: 10:37 AM
 * To change this template use File | Settings | File Templates.
 */
namespace App\Controller\Component;


use App\Model\Entity\Character;
use App\Model\Entity\Permission;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use classes\character\data\CharacterStatus;


/**
 * @property Component\AuthComponent Auth
 * @property PermissionsComponent Permissions
 */
class MenuComponent extends Component
{
    public $components = array(
        'Auth',
        'Permissions',
        'Session'
    );

    private $menu = array();

    public function InitializeMenu()
    {
        $menuComponents = include_once(ROOT . '/lib/menu_components.php');
        $this->menu = $menuComponents['base'];
        if (!is_array($this->menu)) {
            return;
        }

        if ($this->Auth->user('user_id') != 1) {
            $this->menu = array_merge_recursive($this->menu, $menuComponents['player']);
        }

        if ($this->Permissions->isGM()) {
            $this->menu = array_merge_recursive($this->menu, $menuComponents['GameMaster']);
        }

        if($this->Permissions->CheckSitePermission($this->Auth->user('user_id'), Permission::$EditUsers)) {
            $this->menu = array_merge_recursive($this->menu, $menuComponents['EditUsers']);
        }

        if($this->Permissions->CheckSitePermission($this->Auth->user('user_id'), Permission::$Admin)) {
            $this->menu = array_merge_recursive($this->menu, $menuComponents['Admin']);
        }

    }

    public function GetMenu()
    {
        return $this->menu;
    }

    public function createStorytellerMenu()
    {
    }

    public function createCharacterMenu($characterId, $characterName, $characterSlug = null)
    {
    }
}
