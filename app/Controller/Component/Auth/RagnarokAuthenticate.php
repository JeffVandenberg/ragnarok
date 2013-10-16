<?php
/**
 * Created by JetBrains PhpStorm.
 * User: JeffVandenberg
 * Date: 5/25/13
 * Time: 10:07 AM
 * To change this template use File | Settings | File Templates.
 */
App::uses('BaseAuthenticate', 'Controller/Component/Auth');

class RagnarokAuthenticate extends BaseAuthenticate {
    public function authenticate(CakeRequest $request, CakeResponse $response) {
        global $userdata;

        if(isset($userdata) && ($userdata !== null) && ($userdata['user_id'] != 1)) {
            return $userdata;
        }
        return false;
    }

    public function logout($user)
    {
        global $userdata;
        $user = null;
        return '/';
    }


}