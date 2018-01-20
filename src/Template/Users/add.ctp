<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('user_type');
		echo $this->Form->input('group_id');
		echo $this->Form->input('user_permissions');
		echo $this->Form->input('user_perm_from');
		echo $this->Form->input('user_ip');
		echo $this->Form->input('user_regdate');
		echo $this->Form->input('username');
		echo $this->Form->input('username_clean');
		echo $this->Form->input('user_password');
		echo $this->Form->input('user_passchg');
		echo $this->Form->input('user_pass_convert');
		echo $this->Form->input('user_email');
		echo $this->Form->input('user_email_hash');
		echo $this->Form->input('user_birthday');
		echo $this->Form->input('user_lastvisit');
		echo $this->Form->input('user_lastmark');
		echo $this->Form->input('user_lastpost_time');
		echo $this->Form->input('user_lastpage');
		echo $this->Form->input('user_last_confirm_key');
		echo $this->Form->input('user_last_search');
		echo $this->Form->input('user_warnings');
		echo $this->Form->input('user_last_warning');
		echo $this->Form->input('user_login_attempts');
		echo $this->Form->input('user_inactive_reason');
		echo $this->Form->input('user_inactive_time');
		echo $this->Form->input('user_posts');
		echo $this->Form->input('user_lang');
		echo $this->Form->input('user_timezone');
		echo $this->Form->input('user_dst');
		echo $this->Form->input('user_dateformat');
		echo $this->Form->input('user_style');
		echo $this->Form->input('user_rank');
		echo $this->Form->input('user_colour');
		echo $this->Form->input('user_new_privmsg');
		echo $this->Form->input('user_unread_privmsg');
		echo $this->Form->input('user_last_privmsg');
		echo $this->Form->input('user_message_rules');
		echo $this->Form->input('user_full_folder');
		echo $this->Form->input('user_emailtime');
		echo $this->Form->input('user_topic_show_days');
		echo $this->Form->input('user_topic_sortby_type');
		echo $this->Form->input('user_topic_sortby_dir');
		echo $this->Form->input('user_post_show_days');
		echo $this->Form->input('user_post_sortby_type');
		echo $this->Form->input('user_post_sortby_dir');
		echo $this->Form->input('user_notify');
		echo $this->Form->input('user_notify_pm');
		echo $this->Form->input('user_notify_type');
		echo $this->Form->input('user_allow_pm');
		echo $this->Form->input('user_allow_viewonline');
		echo $this->Form->input('user_allow_viewemail');
		echo $this->Form->input('user_allow_massemail');
		echo $this->Form->input('user_options');
		echo $this->Form->input('user_avatar');
		echo $this->Form->input('user_avatar_type');
		echo $this->Form->input('user_avatar_width');
		echo $this->Form->input('user_avatar_height');
		echo $this->Form->input('user_sig');
		echo $this->Form->input('user_sig_bbcode_uid');
		echo $this->Form->input('user_sig_bbcode_bitfield');
		echo $this->Form->input('user_from');
		echo $this->Form->input('user_icq');
		echo $this->Form->input('user_aim');
		echo $this->Form->input('user_yim');
		echo $this->Form->input('user_msnm');
		echo $this->Form->input('user_jabber');
		echo $this->Form->input('user_website');
		echo $this->Form->input('user_occ');
		echo $this->Form->input('user_interests');
		echo $this->Form->input('user_actkey');
		echo $this->Form->input('user_newpasswd');
		echo $this->Form->input('user_form_salt');
		echo $this->Form->input('user_new');
		echo $this->Form->input('user_reminded');
		echo $this->Form->input('user_reminded_time');
		echo $this->Form->input('Permission');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Permissions'), array('controller' => 'permissions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Permission'), array('controller' => 'permissions', 'action' => 'add')); ?> </li>
	</ul>
</div>
