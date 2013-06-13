<div class="aspectTypes index">
	<h2><?php echo __('Aspect Types'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($aspectTypes as $aspectType): ?>
	<tr>
		<td><?php echo h($aspectType['AspectType']['id']); ?>&nbsp;</td>
		<td><?php echo h($aspectType['AspectType']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $aspectType['AspectType']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $aspectType['AspectType']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $aspectType['AspectType']['id']), null, __('Are you sure you want to delete # %s?', $aspectType['AspectType']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Aspect Type'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Character Aspects'), array('controller' => 'character_aspects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Character Aspect'), array('controller' => 'character_aspects', 'action' => 'add')); ?> </li>
	</ul>
</div>
