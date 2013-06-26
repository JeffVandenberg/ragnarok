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
        $sessionId = '';
        foreach($_COOKIE AS $key => $value)
        {
            if(strpos($key, '_sid') > 0)
            {
                $sessionId = $value;
            }
        }

        App::uses('User', 'Model');
        $userDb = new User();
        $sessionCheck = <<<EOQ
select
    S.*,
    U.*
FROM
    pinky_sessions AS S
    INNER JOIN pinky_users AS U ON S.session_user_id = U.user_id
WHERE
    S.session_id = '$sessionId'
    AND U.user_type != 2
EOQ;

        $sessionInfo = $userDb->query($sessionCheck);
        if(count($sessionInfo))
        {
            $_SESSION['session_id'] = $sessionId;
            $_SESSION['username'] = $sessionInfo[0]['U']['username'];
            $_SESSION['user_id'] = $sessionInfo[0]['U']['user_id'];
            return $sessionInfo[0]['U'];
        }

        return false;
    }

    public function logout($user)
    {
        $_SESSION['session_id'] = null;
        $_SESSION['user_id'] = null;
        $_SESSION['Auth'] = null;
        $_SESSION['username'] = null;
        $_SESSION['logged_in'] = null;
    }


}