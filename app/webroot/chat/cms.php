<?php
#############################################
# Author: Pro Chatrooms
# Software: Pro Chatrooms
# Url: http://www.prochatrooms.com
# Support: support@prochatrooms.com
############################################# 


// INTEGRATION NOTES FOR CUSTOM DEVELOPERS

// You can insert your existing CMS user Global values into the 
// login procedure. Simply replace the values $_FOO['username'] 
// and $_FOO['userid'] with your SESSION, COOKIE or MySQL results.

// Example Code:

// define('C_CUSTOM_LOGIN','1'); // 0 OFF, 1 ON
// define('C_CUSTOM_USERNAME',$_SESSION['username']); // username
// define('C_CUSTOM_USERID',$_SESSION['userid']); // userid
// if(!isset($_SESSION['userid']) || empty($_SESSION['userid']))
// {
//	 die("userid value is null");
// }

// You will be able to link directly to the chat room by adding 
// an <a href> link to your web pages like shown below and only 
// registered users will be able to auto-login to your chat room.

// <a href="http://yoursite.com/prochatrooms/">Chat Room</a>


## CUSTOM INTEGRATION SETTINGS ##############


// Enable custom login details

use phpbb\request\request;

define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '../forum/';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
$request = $phpbb_container->get('request');
/* @var request $request */
$request->enable_super_globals();

//
// Start session management
//

$user->session_begin();
$auth->acl($user->data);
$userdata = $user->data;

define('C_CUSTOM_LOGIN','1'); // 0 OFF, 1 ON

// Enter your CMS Global values below

$loggedIn = false;
if(isset($_GET['character_id'])) {
    $characterId = (int) $_GET['character_id'];
    $query = <<<EOQ
SELECT
    C.character_name,
    C.character_status_id
FROM
    characters AS C
WHERE
    C.id = ?
	AND C.created_by_id = ?
EOQ;

    /* @var PDO $dbh */
    $dbh = db_connect();
    $action = $dbh->prepare($query);
    $action->execute(array($characterId, $userdata['user_id']));
    $character = $action->fetch(PDO::FETCH_ASSOC);

    if($character === false) {
        die('Not allowed');
    }
    define('C_CUSTOM_USERNAME', $character['character_name']); // username
    define('C_CUSTOM_USERID', $characterId); // userid
    define('C_CUSTOM_ACTION', 'CHARACTER LOGIN');

    $icon = 'player.png';
    if($character['is_sanctioned'] == 'Y') {
    }
    if($character['is_sanctioned'] == 'N') {
    }

    $_SESSION['username'] = str_replace('\'', '\\\'', C_CUSTOM_USERNAME);
    $_SESSION['userid'] = C_CUSTOM_USERID;
    $_SESSION['userGroup'] = 2;
    $_SESSION['is_invisible'] = 0;
    $userTypeId = 3;
    addUser($icon, $userTypeId);

    $query = <<<EOQ
UPDATE
    prochatrooms_users
SET
    display_name = :name,
    usergroup = '2',
    admin = '0',
    moderator = '0',
    avatar = :icon
WHERE
    username = :username
    AND userid = :userid
EOQ;

    $action = $dbh->prepare($query);
    $action->bindValue('userid', C_CUSTOM_USERID, PDO::PARAM_INT);
    $action->bindValue('username', C_CUSTOM_USERNAME);
    $action->bindValue('icon', $icon);
    $action->bindValue('name', C_CUSTOM_USERNAME);
    $action->execute();

    $loggedIn = true;
}
else if(isset($_GET['gm_login']) || ($_GET['action'] == 'gm_login')) {
    $dbh = db_connect();
    $query = "SELECT * FROM permissions_users WHERE user_id = ? AND permission_id = ?";
    $action = $dbh->prepare($query);
    $action->execute(array($userdata['user_id'], 5));

    if($action->rowCount() > 0) {
        define('C_CUSTOM_USERNAME', $userdata['username']);
        define('C_CUSTOM_USERID', $userdata['user_id']);

        $_SESSION['username'] = str_replace('\'', '\\\'', C_CUSTOM_USERNAME);
        $_SESSION['userid'] = C_CUSTOM_USERID;
        $_SESSION['userGroup'] = 3;
        $_SESSION['is_invisible'] = isset($_GET['invisible']);

        $row = $action->fetch(PDO::FETCH_ASSOC);
        $icon = 'gm.png';
        $userTypeId = 4;

        $admin = 0; //($row['Is_Admin'] == 'Y') ? 1 : 0;
        $action = $dbh->prepare($query);
        $action->execute(array($userdata['user_id'], 2));
        if($action->rowCount() > 0) {
            $admin = 1;
            $icon = 'admin.png';
            $userTypeId = 6;
        }

        if(!$admin) {
            $action = $dbh->prepare($query);
            $action->execute(array($userdata['user_id'], 6));
            if($action->rowCount() > 0) {
                $icon = 'wiki.png';
                $userTypeId = 7;
            }
        }

        addUser($icon, $userTypeId);

        $mod = 1;

        $query = <<<EOQ
UPDATE
    prochatrooms_users
SET
    display_name = :name,
    usergroup = '3',
    guest = '0',
    admin = '$admin',
    moderator = '$mod',
    avatar = '$icon'
WHERE
    username = :username
    AND userid = :userid
EOQ;

        $action = $dbh->prepare($query);
        $action->bindValue('userid', $userdata['user_id'], PDO::PARAM_INT);
        $action->bindValue('username', $userdata['username']);
        $action->bindValue('name', C_CUSTOM_USERNAME);
        $action->execute();
        $loggedIn = true;
    }
    else {
        // check if they have a profile and remove moderator permissions
        $query = <<<EOQ
UPDATE
    prochatrooms_users
SET
    usergroup = '2',
    guest = '0',
    admin = '0',
    moderator = '0',
    speaker = '0'
WHERE
    username = :username
    AND userid = :userid
EOQ;
        $action = $dbh->prepare($query);
        $action->bindValue('userid', C_CUSTOM_USERID, PDO::PARAM_INT);
        $action->bindValue('username', C_CUSTOM_USERNAME);
        $action->execute();
        die('You do not have ST Permissions');
    }
}
else if($userdata['username'] !== 'Anonymous') {
    define('C_CUSTOM_USERNAME', $userdata['username']); // username
    define('C_CUSTOM_USERID', $userdata['user_id']); // userid
    define('C_CUSTOM_ACTION', 'OOC LOGIN');

    $_SESSION['username'] = str_replace('\'', '\\\'', C_CUSTOM_USERNAME);
    $_SESSION['userid'] = C_CUSTOM_USERID;
    $_SESSION['userGroup'] = 2;
    $_SESSION['is_invisible'] = 0;
    $icon = 'ooc.png';

    $dbh = db_connect();

    $userTypeId = 2;
    addUser($icon, $userTypeId);

    $query = <<<EOQ
UPDATE
    prochatrooms_users
SET
    display_name = :name,
    usergroup = '2',
    admin = '0',
    moderator = '0',
    guest = '0',
    avatar = '$icon'
WHERE
    username = :username
    AND userid = :userid
EOQ;

    $action = $dbh->prepare($query);
    $action->bindValue('userid', C_CUSTOM_USERID, PDO::PARAM_INT);
    $action->bindValue('username', C_CUSTOM_USERNAME);
    $action->bindValue('name', C_CUSTOM_USERNAME);
    $action->execute();
    $loggedIn = true;
}
else if(isset($_POST['data']['username']) && (trim($_POST['data']['username']) !== '')) {
    define('C_CUSTOM_USERNAME', $_POST['data']['username']);
    define('C_CUSTOM_USERID', -1); // userid
    define('C_CUSTOM_ACTION', 'GUEST LOGIN');

    $_SESSION['username'] = str_replace('\'', '\\\'', C_CUSTOM_USERNAME);
    $_SESSION['userid'] = C_CUSTOM_USERID;
    $_SESSION['userGroup'] = 1;
    $_SESSION['is_invisible'] = 0;
    $userTypeId = 1;
    addUser('ooc.png', $userTypeId);

    $query = <<<EOQ
UPDATE
    prochatrooms_users
SET
    usergroup = '1',
    admin = '0',
    moderator = '0',
    guest = '1',
    avatar = 'ooc.png'
WHERE
    username = :username
    AND userid = :userid
EOQ;

    $dbh = db_connect();
    $action = $dbh->prepare($query);
    $action->bindValue('userid', C_CUSTOM_USERID, PDO::PARAM_INT);
    $action->bindValue('username', C_CUSTOM_USERNAME);
    $action->execute();
    $loggedIn = true;
}
else {
    header('location:http://ragnarok.gamingsandbox.com/');
    die();
}

if(!$loggedIn)
{
    die("Not Logged In.");
}

$sql = <<<EOQ
SELECT
    id
FROM
    prochatrooms_users
WHERE
    `username` = ?
    AND `userid` = ?
    AND `user_type_id` = ?
EOQ;

$statement = $dbh->prepare($sql);
$params = array(C_CUSTOM_USERNAME, C_CUSTOM_USERID, $userTypeId);
$statement->execute($params);
$result = $statement->fetch(PDO::FETCH_ASSOC);

// set chat information
// session login
$_SESSION['username'] = C_CUSTOM_USERNAME;
$_SESSION['userid'] = C_CUSTOM_USERID;
$_SESSION['display_name'] = C_CUSTOM_USERNAME;
$_SESSION['user_id'] = $result['id'];
$_SESSION['user_type_id'] = $userTypeId;

## DO NOT EDIT BELOW THIS LINE ##############


// if remote login via CMS

	if($remotely_hosted){

		// check username isset
		if(!isset($_COOKIE["uname"])){

			header("Location: error.php");
			die;

		}

		// if userid is null, assign userid
		if(!isset($_COOKIE["uid"])){

			$uid='-1';

		}else{

			$uid=$_COOKIE["uid"];

		}

	}

// if custom login

	if(C_CUSTOM_LOGIN){

		// assign username
		$uname = C_CUSTOM_USERNAME;

		if(!C_CUSTOM_USERID){

			// userid empty
			$uid = '-1';

		}else{

			// assign userid
			$uid = C_CUSTOM_USERID;

		}

	}

// if default login

	if(!$remotely_hosted && !C_CUSTOM_LOGIN){

	?>

		<SCRIPT LANGUAGE="JavaScript1.2">
		<!-- 
		function getCookieVal (offset) {
	  		var endstr = document.cookie.indexOf (";", offset);
	  		if (endstr == -1)
	  		endstr = document.cookie.length;
	  		return unescape(document.cookie.substring(offset, endstr));
		}
		function GetCookie (name) {
	  		var arg = name + "=";
	  		var alen = arg.length;
	  		var clen = document.cookie.length;
	  		var i = 0;
	  		while (i < clen) {
	    		var j = i + alen;
	    		if (document.cookie.substring(i, j) == arg)
	    		return getCookieVal (j);
	    		i = document.cookie.indexOf(" ", i) + 1;
	    		if (i == 0) break;
	  		}
	  		return null;
		}
		if(GetCookie("login") == null){ 
			window.location="error.php";
		}
		// -->
		</SCRIPT>

<?php }?>
