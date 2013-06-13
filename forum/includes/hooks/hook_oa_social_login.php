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
if (!defined ('IN_PHPBB'))
{
	exit;
}

/**
 * Hook for callback handler
 */
function oa_social_login_callback_hook (&$hook)
{
	global $phpbb_root_path, $phpEx;

	//Required Class
	include_once($phpbb_root_path . 'includes/functions_oa_social_login.' . $phpEx);

	//Handle Callback
	$oa_social_login = new oa_social_login ();
	$oa_social_login->handle_callback ();
}

/**
 * Hook to include library and setup template
 */
function oa_social_login_template_hook (&$hook)
{
	global $template, $phpbb_root_path, $phpEx;

	//Required Class
	require_once($phpbb_root_path . 'includes/functions_oa_social_login.' . $phpEx);

	//Handle Callback
	$oa_social_login = new oa_social_login ();
	$oa_social_login->setup_template ($template);
}

/**
 * Setup Hooks
 */
if (!defined ('IN_OAS_INSTALL'))
{
	if (!is_array ($config) || !isset ($config ['board_disable']) || $config ['board_disable'] == false)
	{
		$phpbb_hook->register ('phpbb_user_session_handler', 'oa_social_login_callback_hook');
		$phpbb_hook->register (array ('template', 'display'), 'oa_social_login_template_hook');
	}
}

?>