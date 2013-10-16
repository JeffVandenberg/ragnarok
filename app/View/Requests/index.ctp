<div class="requests index">
	<h2><?php echo __('Requests'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('character_id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('body'); ?></th>
			<th><?php echo $this->Paginator->sort('request_type_id'); ?></th>
			<th><?php echo $this->Paginator->sort('request_status_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created_by_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created_on'); ?></th>
			<th><?php echo $this->Paginator->sort('updated_by_id'); ?></th>
			<th><?php echo $this->Paginator->sort('updated_on'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($requests as $request): ?>
	<tr>
		<td><?php echo h($request['Request']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($request['Character']['character_name'], array('controller' => 'characters', 'action' => 'view', $request['Character']['id'])); ?>
		</td>
		<td><?php echo h($request['Request']['title']); ?>&nbsp;</td>
		<td><?php echo h($request['Request']['body']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($request['RequestType']['name'], array('controller' => 'request_types', 'action' => 'view', $request['RequestType']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($request['RequestStatus']['name'], array('controller' => 'request_statuses', 'action' => 'view', $request['RequestStatus']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($request['CreatedBy']['username'], array('controller' => 'users', 'action' => 'view', $request['CreatedBy']['user_id'])); ?>
		</td>
		<td><?php echo h($request['Request']['created_on']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($request['UpdatedBy']['username'], array('controller' => 'users', 'action' => 'view', $request['UpdatedBy']['user_id'])); ?>
		</td>
		<td><?php echo h($request['Request']['updated_on']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $request['Request']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $request['Request']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $request['Request']['id']), null, __('Are you sure you want to delete # %s?', $request['Request']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Request'), array('action' => 'add')); ?></li>
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
