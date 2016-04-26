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
        if($this->request->is('post')) {
            // try to save
            if($this->Configuration->saveAll($this->request->data)) {
                // alert characters of new skill levels
                App::uses('Character', 'Model');
                $charRepo = new Character();
                $charRepo->updateSkillLevelOnCharacters($this->request->data['Configuration']['skill_level']);
                $this->Session->setFlash('Updated Configuration');
                $this->redirect(array('action' => 'index'));
            }
            else {
                debug($this->Configuration->validationErrors);
                $this->Session->setFlash('Error Saving');
            }
        }
        $this->set('configs', $this->Configuration->find('all'));
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