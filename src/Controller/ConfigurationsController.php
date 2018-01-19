<?php
namespace App\Controller;

use App\Controller\Component\PermissionsComponent;
use App\Model\Entity\Permission;
use App\Model\Table\ConfigurationsTable;
use Cake\Event\Event;

/**
 * Created by PhpStorm.
 * User: JeffVandenberg
 * Date: 5/20/14
 * Time: 8:21 PM
 * @property PermissionsComponent $Permissions
 * @property ConfigurationsTable $Configurations
 */

class ConfigurationsController extends AppController {

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->deny();
    }

    public function index() {
        $this->set('configs', $this->Configurations->find('all'));
    }

    public function edit() {
        $configs = $this->Configurations->find('all')->toList();
        if($this->request->is('post')) {
            // try to save
            $newConfigs = $this->Configurations->patchEntities($configs, $this->request->getData());
            if($this->Configurations->saveMany($newConfigs)) {
                $event = new Event('config.update', $this, [
                    'old_config' => $configs,
                    'new_config' => $newConfigs
                ]);
                // alert characters of new skill levels
                $this->getEventManager()->dispatch($event);
                $this->Flash->set('Updated Configuration');
                $this->redirect(array('action' => 'index'));
            }
            else {
                $this->Flash->set('Error Saving');
            }
        }
        $this->set('configs', $configs);
    }

    public function isAuthorized($user = null)
    {
        switch ($this->request->getParam('action')) {
            case 'index':
            case 'edit':
                return $this->Permissions->CheckSitePermission($this->Auth->user('user_id'), Permission::$Admin);
                break;
        }
        return false;
    }
}
