<?php
/**
 * Created by JetBrains PhpStorm.
 * User: JeffVandenberg
 * Date: 7/22/13
 * Time: 10:21 AM
 * To change this template use File | Settings | File Templates.
 */

class ChatblazerController extends AppController {
    public function index()
    {
        die('here');
        $this->layout = false;
        if($this->request->data['username'])
        {
            $userName = htmlspecialchars($this->request->data['username']);
        }
        else
        {
            $userName = 'Unknown User ' . mt_rand(10000, 99999);
        }
        $this->set(compact('userName'));
    }
}