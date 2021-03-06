<?php

/**
 * Created by JetBrains PhpStorm.
 * User: JeffVandenberg
 * Date: 4/14/13
 * Time: 11:40 AM
 * To change this template use File | Settings | File Templates.
 * @property ConfigComponent Config
 */
namespace App\Controller;



use Cake\Event\Event;

class WelcomeController extends AppController {
    public $helpers = array(
    );

    public $components = array(
        'Config'
    );

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow();
    }

    public function home () {
        $frontPage = $this->Config->Read('FRONT_PAGE');
        $this->set(compact('frontPage'));
    }

    public function chat () {
        $this->set('name', $this->request->getData('name'));
    }

    public function chat2() {
        $this->set('name', $this->request->getData('name'));
    }

    public function sheet () {
        $skillSpreads = array(
            1 => '5/5/5',
            2 => '2/3/4/5',
            3 => '3/3/3/3',
            4 => '2/2/2/2/2'
        );
        $this->set(compact('skillSpreads'));
    }

    public function gsNews() {
        echo $this->Config->read('gs_frontpage');
        die();
    }

    public function down() {

    }
}
