<?php
/**
 * Created by JetBrains PhpStorm.
 * User: JeffVandenberg
 * Date: 4/14/13
 * Time: 12:26 PM
 * To change this template use File | Settings | File Templates.
 */

App::uses('AppHelper', 'View/Helper');

class LoginHelper extends AppHelper
{
    public $helpers = array(
        'Html',
        'Session'
    );

    public function GetUserBox()
    {
        /* @var View $this */
        $basePath = $this->Html->url('/');
        $thisPage = $this->Html->url();

        $auth = $this->Session->read('Auth');
        if (count($auth) > 0) {
            $userName = $auth['User']['username'];
            $sessionId = $this->Session->read('session_id');
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
            $serverName = Configure::read('site.subhost');
            $userBox = <<<EOQ
<h3>Login</h3>
<div style="height:50px;overflow:hidden;width:200px ">
    <div class="input">
        <label>
            Social Login
        </label>
        <script src="http://gamingsandbox.api.oneall.com/socialize/library.js" type="text/javascript"></script>
        <span class="oneall_social_login_providers" id="oneall_social_login_providers_3937889"></span>
    </div>
    <script type="text/javascript">
        oneall.api.plugins.social_login.build("oneall_social_login_providers_3937889", {
            'providers' :  ['facebook','twitter','google','openid','wordpress'],
            'callback_uri': 'http://{$serverName}forum/index.php' ,
            'css_theme_uri' : (("https:" == "http") ? "https://secure." : "http://public.") + 'oneallcdn.com/css/api/socialize/themes/phpbb/small.css'
        });
    </script>
    <!-- oneall.com / Social Login for phpBB / v1.8.0 -->
</div>
<form method="post" action="{$basePath}forum/ucp.php?mode=login">
    <div class="input text">
        <label for="username">Username</label>
        <input name="username" type="text" id="username"/>
    </div>
    <div class="input password">
        <label for="password">Password</label>
        <input name="password" type="password" id="password"/>
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