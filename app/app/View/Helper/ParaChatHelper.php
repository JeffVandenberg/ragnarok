<?php
/**
 * Created by JetBrains PhpStorm.
 * User: JeffVandenberg
 * Date: 4/16/13
 * Time: 8:55 PM
 * To change this template use File | Settings | File Templates.
 */

App::uses('AppHelper', 'View/Helper');

class ParaChatHelper extends AppHelper {
    public function makeChat($userName) {
        $chatContent = <<<EOQ
<!-- Begin ParaChat BasicPlus -->
<!--<iframe src="http://host7.parachat.com/bp/login.html?site=31646&room=Lobby&width=850&height=600&bg=eeeeee&fg=000000&Ctrl.AutoLogin=true&Net.User=$userName" framespacing="0" frameborder="no" scrolling="no" width="850" height="600">-->
<iframe src="http://host7.parachat.com/pchat/applet/if.php?site=31646&room=Lobby&width=850&height=600&bg=eeeeee&fg=000000&Ctrl.AutoLogin=true&Net.User=$userName" style="border-style:ridge;border-width:4px;border-color:#eeeeee #eeeeee;background-color:#eeeeee;" framespacing='0' frameborder='0' scrolling='no' width='850' height='600'> 
<p>You do not have iframes enabled. <a href="http://www.parachat.com/iframe.html">More Info</a></p></iframe><a href="http://www.parachat.com"><img src="http://www.parachat.com/images/basic.png" border="0"></a>
<!-- End ParaChat BasicPlus -->
EOQ;
        return $chatContent;
    }

}