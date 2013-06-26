<?php
App::uses('AppHelper', 'View/Helper');

class AddOnChatHelper extends AppHelper {
    public function makeChat($userName) {
        $chatContent = <<<EOQ
         <script type="text/javascript">
             var addonchat = {
                 server:1,
                 id:593000,
                 width:"850",
                 height:"600",
                 language:"en"
             }
             var addonchat_param = {
                 username:"$userName",
                 autologin:1
             }
         </script>
         <script type="text/javascript"
                 src="http://client16.addonchat.com/chat.js"></script><noscript>
             To enter this chat room, please enable JavaScript in your web
             browser. This <a href="http://www.addonchat.com/">Chat
                 Software</a> requires Java: <a href="http://www.java.com/">Get
                 Java Now</a>
         </noscript>
EOQ;
        return $chatContent;
    }
}