<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jvandenberg
 * Date: 4/16/13
 * Time: 2:02 PM
 * To change this template use File | Settings | File Templates.
 */

define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
/** @noinspection PhpIncludeInspection */
require($phpbb_root_path . 'common.' . $phpEx);
/** @noinspection PhpIncludeInspection */
require($phpbb_root_path . 'includes/functions_user.' . $phpEx);

$cp_data = array();
$is_dst = true;
$username = $_GET['user_name'];
$password = $_GET['password'];
$email = $_GET['email_address'];

// Which group by default?
$group_name = 'REGISTERED';

$sql = 'SELECT group_id
        FROM ' . GROUPS_TABLE . "
		WHERE group_name = '" . $db->sql_escape($group_name) . "'
		AND group_type = " . GROUP_SPECIAL;
$result = $db->sql_query($sql);
$row = $db->sql_fetchrow($result);
$db->sql_freeresult($result);

$group_id = $row['group_id'];
$timeZone = $_GET['timezone'];
$user_type = USER_NORMAL;
$user_key = '';

$user_inactive_reason = 0;
$user_inactive_time = 0;

$user_row = array(
    'username'				=> $username,
    'user_password'			=> phpbb_hash($password),
    'username_clean'        => '',
    'user_email'			=> $email,
    'group_id'				=> (int) $group_id,
    'user_timezone'			=> (float) $timeZone,
    'user_dst'				=> $is_dst,
    'user_lang'				=> 'en',
    'user_type'				=> $user_type,
    'user_actkey'			=> $user_key,
    'user_ip'				=> '127.0.0.1',
    'user_regdate'			=> time(),
    'user_inactive_reason'	=> $user_inactive_reason,
    'user_inactive_time'	=> $user_inactive_time,
);

$user_id = user_add($user_row, $cp_data);
echo $user_id;