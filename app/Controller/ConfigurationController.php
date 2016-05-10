<?php

/**
 * Created by PhpStorm.
 * User: JeffVandenberg
 * Date: 5/20/14
 * Time: 8:21 PM
 * @property RagnarokPermissionsComponent RagnarokPermissions
 * @property Configuration Configuration
 */

class ConfigurationController extends AppController {

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->deny();
    }

    public function index() {
        $this->set('configs', $this->Configuration->find('all'));
    }

    public function edit() {
        $configs = $this->Configuration->find('all');
        if($this->request->is('post')) {
            // try to save
            if($this->Configuration->saveAll($this->request->data)) {
                $event = new CakeEvent('config.update', $this, [
                    'old_config' => $configs,
                    'new_config' => $this->request->data
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
        switch ($this->request->params['action']) {
            case 'index':
            case 'edit':
                return $this->RagnarokPermissions->CheckPermission($this->Auth->user('user_id'), Permission::$Admin);
                break;
        }
        return false;
    }
}
