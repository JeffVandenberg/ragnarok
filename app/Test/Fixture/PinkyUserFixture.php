<?php
/**
 * PinkyUserFixture
 *
 */
class PinkyUserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 8, 'key' => 'primary'),
		'user_type' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2, 'key' => 'index'),
		'group_id' => array('type' => 'integer', 'null' => false, 'default' => '3', 'length' => 8),
		'user_permissions' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_perm_from' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 8),
		'user_ip' => array('type' => 'string', 'null' => false, 'length' => 40, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_regdate' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'username' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'username_clean' => array('type' => 'string', 'null' => false, 'key' => 'unique', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_password' => array('type' => 'string', 'null' => false, 'length' => 40, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_passchg' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'user_pass_convert' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'user_email' => array('type' => 'string', 'null' => false, 'length' => 100, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_email_hash' => array('type' => 'biginteger', 'null' => false, 'default' => '0', 'key' => 'index'),
		'user_birthday' => array('type' => 'string', 'null' => false, 'length' => 10, 'key' => 'index', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_lastvisit' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'user_lastmark' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'user_lastpost_time' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'user_lastpage' => array('type' => 'string', 'null' => false, 'length' => 200, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_last_confirm_key' => array('type' => 'string', 'null' => false, 'length' => 10, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_last_search' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'user_warnings' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'user_last_warning' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'user_login_attempts' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'user_inactive_reason' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2),
		'user_inactive_time' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'user_posts' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 8),
		'user_lang' => array('type' => 'string', 'null' => false, 'length' => 30, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_timezone' => array('type' => 'float', 'null' => false, 'default' => '0.00', 'length' => '5,2'),
		'user_dst' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'user_dateformat' => array('type' => 'string', 'null' => false, 'default' => 'd M Y H:i', 'length' => 30, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_style' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 8),
		'user_rank' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 8),
		'user_colour' => array('type' => 'string', 'null' => false, 'length' => 6, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_new_privmsg' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'user_unread_privmsg' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'user_last_privmsg' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'user_message_rules' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'user_full_folder' => array('type' => 'integer', 'null' => false, 'default' => '-3'),
		'user_emailtime' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'user_topic_show_days' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'user_topic_sortby_type' => array('type' => 'string', 'null' => false, 'default' => 't', 'length' => 1, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_topic_sortby_dir' => array('type' => 'string', 'null' => false, 'default' => 'd', 'length' => 1, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_post_show_days' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'user_post_sortby_type' => array('type' => 'string', 'null' => false, 'default' => 't', 'length' => 1, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_post_sortby_dir' => array('type' => 'string', 'null' => false, 'default' => 'a', 'length' => 1, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_notify' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'user_notify_pm' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'user_notify_type' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'user_allow_pm' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'user_allow_viewonline' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'user_allow_viewemail' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'user_allow_massemail' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'user_options' => array('type' => 'integer', 'null' => false, 'default' => '230271'),
		'user_avatar' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_avatar_type' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2),
		'user_avatar_width' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'user_avatar_height' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'user_sig' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_sig_bbcode_uid' => array('type' => 'string', 'null' => false, 'length' => 8, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_sig_bbcode_bitfield' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_from' => array('type' => 'string', 'null' => false, 'length' => 100, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_icq' => array('type' => 'string', 'null' => false, 'length' => 15, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_aim' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_yim' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_msnm' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_jabber' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_website' => array('type' => 'string', 'null' => false, 'length' => 200, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_occ' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_interests' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_actkey' => array('type' => 'string', 'null' => false, 'length' => 32, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_newpasswd' => array('type' => 'string', 'null' => false, 'length' => 40, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_form_salt' => array('type' => 'string', 'null' => false, 'length' => 32, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_new' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'user_reminded' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'user_reminded_time' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'user_id', 'unique' => 1),
			'username_clean' => array('column' => 'username_clean', 'unique' => 1),
			'user_birthday' => array('column' => 'user_birthday', 'unique' => 0),
			'user_email_hash' => array('column' => 'user_email_hash', 'unique' => 0),
			'user_type' => array('column' => 'user_type', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_bin', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'user_id' => 1,
			'user_type' => 1,
			'group_id' => 1,
			'user_permissions' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'user_perm_from' => 1,
			'user_ip' => 'Lorem ipsum dolor sit amet',
			'user_regdate' => 1,
			'username' => 'Lorem ipsum dolor sit amet',
			'username_clean' => 'Lorem ipsum dolor sit amet',
			'user_password' => 'Lorem ipsum dolor sit amet',
			'user_passchg' => 1,
			'user_pass_convert' => 1,
			'user_email' => 'Lorem ipsum dolor sit amet',
			'user_email_hash' => '',
			'user_birthday' => 'Lorem ip',
			'user_lastvisit' => 1,
			'user_lastmark' => 1,
			'user_lastpost_time' => 1,
			'user_lastpage' => 'Lorem ipsum dolor sit amet',
			'user_last_confirm_key' => 'Lorem ip',
			'user_last_search' => 1,
			'user_warnings' => 1,
			'user_last_warning' => 1,
			'user_login_attempts' => 1,
			'user_inactive_reason' => 1,
			'user_inactive_time' => 1,
			'user_posts' => 1,
			'user_lang' => 'Lorem ipsum dolor sit amet',
			'user_timezone' => 1,
			'user_dst' => 1,
			'user_dateformat' => 'Lorem ipsum dolor sit amet',
			'user_style' => 1,
			'user_rank' => 1,
			'user_colour' => 'Lore',
			'user_new_privmsg' => 1,
			'user_unread_privmsg' => 1,
			'user_last_privmsg' => 1,
			'user_message_rules' => 1,
			'user_full_folder' => 1,
			'user_emailtime' => 1,
			'user_topic_show_days' => 1,
			'user_topic_sortby_type' => 'Lorem ipsum dolor sit ame',
			'user_topic_sortby_dir' => 'Lorem ipsum dolor sit ame',
			'user_post_show_days' => 1,
			'user_post_sortby_type' => 'Lorem ipsum dolor sit ame',
			'user_post_sortby_dir' => 'Lorem ipsum dolor sit ame',
			'user_notify' => 1,
			'user_notify_pm' => 1,
			'user_notify_type' => 1,
			'user_allow_pm' => 1,
			'user_allow_viewonline' => 1,
			'user_allow_viewemail' => 1,
			'user_allow_massemail' => 1,
			'user_options' => 1,
			'user_avatar' => 'Lorem ipsum dolor sit amet',
			'user_avatar_type' => 1,
			'user_avatar_width' => 1,
			'user_avatar_height' => 1,
			'user_sig' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'user_sig_bbcode_uid' => 'Lorem ',
			'user_sig_bbcode_bitfield' => 'Lorem ipsum dolor sit amet',
			'user_from' => 'Lorem ipsum dolor sit amet',
			'user_icq' => 'Lorem ipsum d',
			'user_aim' => 'Lorem ipsum dolor sit amet',
			'user_yim' => 'Lorem ipsum dolor sit amet',
			'user_msnm' => 'Lorem ipsum dolor sit amet',
			'user_jabber' => 'Lorem ipsum dolor sit amet',
			'user_website' => 'Lorem ipsum dolor sit amet',
			'user_occ' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'user_interests' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'user_actkey' => 'Lorem ipsum dolor sit amet',
			'user_newpasswd' => 'Lorem ipsum dolor sit amet',
			'user_form_salt' => 'Lorem ipsum dolor sit amet',
			'user_new' => 1,
			'user_reminded' => 1,
			'user_reminded_time' => 1
		),
	);

}
