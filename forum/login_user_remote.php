<?php
/**
 * Created by JetBrains PhpStorm.
 * User: JeffVandenberg
 * Date: 4/25/13
 * Time: 9:49 PM
 * To change this template use File | Settings | File Templates.
 */

$username = $_GET['user_name'];
$password = $_GET['password'];

define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
/** @noinspection PhpIncludeInspection */
require($phpbb_root_path . 'common.' . $phpEx);
/** @noinspection PhpIncludeInspection */
require($phpbb_root_path . 'includes/functions_user.' . $phpEx);


$result = $auth->login($username, $password, false, true, false);