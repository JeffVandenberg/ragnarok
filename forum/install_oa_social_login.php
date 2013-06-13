<?php
/**
 * @package   	OneAll Social Login Mod
 * @copyright 	Copyright 2012 http://www.oneall.com - All rights reserved.
 * @license   	GNU/GPL 2 or later
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307,USA.
 *
 * The "GNU General Public License" (GPL) is available at
 * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 */
define ('IN_OASL_INSTALL', true);
define ('UMIL_AUTO', true);
define ('IN_PHPBB', true);

$phpbb_root_path = (defined ('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr (strrchr (__FILE__, '.'), 1);

include($phpbb_root_path . 'common.' . $phpEx);
$user->session_begin ();
$auth->acl ($user->data);
$user->setup ();

if (!file_exists ($phpbb_root_path . 'umil/umil_auto.' . $phpEx))
{
	trigger_error ('Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/">phpBB.com/mods/umil</a>', E_USER_ERROR);
}

// The name of the mod to be displayed during installation.
$mod_name = 'OneAll Social Login';

/*
 * The name of the config variable which will hold the currently installed version
 * UMIL will handle checking, setting, and updating the version itself.
 */
$version_config_name = 'oa_social_login_version';


// The language file which will be included when installing
$language_file = 'info_acp_oa_social_login';

/*
 * The array of versions and actions within each.
 * You do not need to order it a specific way (it will be sorted automatically), however, you must enter every version, even if no actions are done for it.
 *
 * You must use correct version numbering.  Unless you know exactly what you can use, only use X.X.X (replacing X with an integer).
 * The version numbering must otherwise be compatible with the version_compare function - http://php.net/manual/en/function.version-compare.php
 */
$versions = array (
	'1.8.0' => array (
		'module_add' => array (
			array (
				'acp',
				'ACP_CLIENT_COMMUNICATION',
				array (
					'module_basename' => 'oa_social_login',
					'module_langname' => 'Social Login Settings',
					'module_mode' => 'index',
					'module_auth' => 'acl_a_server',
				),
			),
		),
		'table_add' => array (
			array (
				$table_prefix . 'oa_social_login_usermeta',
				array (
					'COLUMNS' => array (
						'umeta_id' => array (
							'UINT:10', null, 'auto_increment'
						),
						'user_id' => array (
							'UINT:10', 0
						),
						'meta_key' => array (
							'VCHAR', ''
						),
						'meta_value' => array (
							'TEXT', 	''
						),
					),
					'PRIMARY_KEY' => array (
						'umeta_id'
					),
					'KEYS' => array (
						'user_id' => array (
							'INDEX',
							array (
								'user_id'
							)
						),
						'meta_key' => array (
							'INDEX',
							array (
								'meta_key'
							)
						),
					),
				)
			),
		),
	),
);

// Include the UMIL Auto file, it handles the rest
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);