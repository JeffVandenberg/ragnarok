<?php
/**
 * Created by JetBrains PhpStorm.
 * User: JeffVandenberg
 * Date: 5/25/13
 * Time: 10:48 AM
 * To change this template use File | Settings | File Templates.
 */

App::uses('BaseAuthorize', 'Controller/Component/Auth');

class RagnarokAuthorize extends BaseAuthorize {
    public function authorize($user, CakeRequest $request) {
        // Do things for ldap here.
        echo "<br /><br />Authorizing something!<br />";
        return true;
    }
}