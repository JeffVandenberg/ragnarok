<?php
/**
 * Created by JetBrains PhpStorm.
 * User: JeffVandenberg
 * Date: 4/14/13
 * Time: 11:40 AM
 * To change this template use File | Settings | File Templates.
 */

class WelcomeController extends AppController {
    public $helpers = array(
        'AddOnChat',
        'ParaChat',
    );

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow();
    }

    public function home () {
    }

    public function chat () {
        $this->set('name', $this->request->data['name']);
    }

    public function chat2() {
        $this->set('name', $this->request->data['name']);
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
}