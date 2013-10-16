<div class="bluebooks index">
	<h2><?php echo __('Bluebooks'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('character_id'); ?></th>
			<th><?php echo $this->Paginator->sort('bluebook_status_id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('body'); ?></th>
			<th><?php echo $this->Paginator->sort('created_by_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('updated_by_id'); ?></th>
			<th><?php echo $this->Paginator->sort('updated'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($bluebooks as $bluebook): ?>
	<tr>
		<td><?php echo h($bluebook['Bluebook']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($bluebook['Character']['character_name'], array('controller' => 'characters', 'action' => 'view', $bluebook['Character']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($bluebook['BluebookStatus']['name'], array('controller' => 'bluebook_statuses', 'action' => 'view', $bluebook['BluebookStatus']['id'])); ?>
		</td>
		<td><?php echo h($bluebook['Bluebook']['title']); ?>&nbsp;</td>
		<td><?php echo h($bluebook['Bluebook']['body']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($bluebook['CreatedBy']['username'], array('controller' => 'users', 'action' => 'view', $bluebook['CreatedBy']['user_id'])); ?>
		</td>
		<td><?php echo h($bluebook['Bluebook']['created']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($bluebook['UpdatedBy']['username'], array('controller' => 'users', 'action' => 'view', $bluebook['UpdatedBy']['user_id'])); ?>
		</td>
		<td><?php echo h($bluebook['Bluebook']['updated']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $bluebook['Bluebook']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $bluebook['Bluebook']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $bluebook['Bluebook']['id']), null, __('Are you sure you want to delete # %s?', $bluebook['Bluebook']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Bluebook'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Characters'), array('controller' => 'characters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Character'), array('controller' => 'characters', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bluebook Statuses'), array('controller' => 'bluebook_statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bluebook Status'), array('controller' => 'bluebook_statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Created By'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rag Requests'), array('controller' => 'rag_requests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Request'), array('controller' => 'rag_requests', 'action' => 'add')); ?> </li>
	</ul>
</div>
