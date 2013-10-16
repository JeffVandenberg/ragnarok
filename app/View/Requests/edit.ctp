<div class="requests form">
<?php echo $this->Form->create('Request'); ?>
	<fieldset>
		<legend><?php echo __('Edit Request'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('character_id');
		echo $this->Form->input('title');
		echo $this->Form->input('body');
		echo $this->Form->input('request_type_id');
		echo $this->Form->input('request_status_id');
		echo $this->Form->input('created_by_id');
		echo $this->Form->input('created_on');
		echo $this->Form->input('updated_by_id');
		echo $this->Form->input('updated_on');
		echo $this->Form->input('Request');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Request.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Request.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Requests'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Characters'), array('controller' => 'characters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Character'), array('controller' => 'characters', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Request Types'), array('controller' => 'request_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Request Type'), array('controller' => 'request_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Request Statuses'), array('controller' => 'request_statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Request Status'), array('controller' => 'request_statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Created By'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Request Characters'), array('controller' => 'request_characters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Request Character'), array('controller' => 'request_characters', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Request Notes'), array('controller' => 'request_notes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Request Note'), array('controller' => 'request_notes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Request Rolls'), array('controller' => 'request_rolls', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Request Roll'), array('controller' => 'request_rolls', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Requests'), array('controller' => 'requests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Request'), array('controller' => 'requests', 'action' => 'add')); ?> </li>
	</ul>
</div>
