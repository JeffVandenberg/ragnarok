<?php
/**
 * Created by JetBrains PhpStorm.
 * User: JeffVandenberg
 * Date: 4/27/13
 * Time: 9:38 PM
 * To change this template use File | Settings | File Templates.
 */
class DiceController extends AppController {

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow();
    }
    public function index() {

    }
}