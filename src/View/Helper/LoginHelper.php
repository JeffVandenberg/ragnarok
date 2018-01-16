<?php
/**
 * Created by JetBrains PhpStorm.
 * User: JeffVandenberg
 * Date: 4/14/13
 * Time: 12:26 PM
 * To change this template use File | Settings | File Templates.
 */
namespace App\View\Helper;

use App\View\AppView;

/**
 */
class LoginHelper extends AppHelper
{
    public $helpers = array(
        'Html',
        'Session'
    );

    public function GetUserBox()
    {
        /* @var AppView $this */
        $basePath = $this->Html->Url->build('/');
        $thisPage = $this->Html->Url->build();

        if ($this->request->getSession()->read('Auth.User.user_id') != 1) {
            $userName = $this->request->getSession()->read('Auth.User.username');
            $sessionId = $this->request->getSession()->read('Auth.User.session_id');
            $userBox = <<<EOQ
<h3>Welcome</h3>
<div class="paragraph">
    Username: $userName
</div>
<div class="paragraph">
    <a href="{$basePath}forum/ucp.php?mode=logout&sid=$sessionId">Logout</a>
</div>
EOQ;

        } else {
            $userBox = <<<EOQ
<h3>Login</h3>
<form method="post" action="{$basePath}forum/ucp.php?mode=login">
    <div class="input text">
        <label for="username">Username</label>
        <input name="username" type="text" id="username"/>
    </div>
    <div class="input password">
        <label for="password">Password</label>
        <input name="password" type="password" id="password"/>
    </div>
    <div class="input checkbox">
        <label for="autologin">Autologin</label>
        <input name="autologin" type="checkbox" id="autologin"/>
    </div>
    <input type="hidden" name="redirect" value="$thisPage" id="redirect" />
    <div class="submit">
        <input name="login" type="submit" value="Login"/>
    </div>
</form>
EOQ;
        }

        return $userBox;
    }
}
