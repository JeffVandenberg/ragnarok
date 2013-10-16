<div class="dicerolls index">
	<h2><?php echo __('DiceRolls'); ?></h2>
	<table>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('character_id'); ?></th>
			<th><?php echo $this->Paginator->sort('roll_total'); ?></th>
			<th><?php echo $this->Paginator->sort('modifier'); ?></th>
			<th><?php echo $this->Paginator->sort('skill_id'); ?></th>
			<th><?php echo $this->Paginator->sort('skill_level'); ?></th>
			<th><?php echo $this->Paginator->sort('fate_spent'); ?></th>
			<th><?php echo $this->Paginator->sort('aspects_tagged'); ?></th>
			<th><?php echo $this->Paginator->sort('created_by_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($dicerolls as $diceRoll): ?>
	<tr>
		<td><?php echo h($diceRoll['DiceRoll']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($diceRoll['Character']['character_name'], array('controller' => 'characters', 'action' => 'view', $diceRoll['Character']['id'])); ?>
		</td>
		<td><?php echo h($diceRoll['DiceRoll']['roll_total']); ?>&nbsp;</td>
		<td><?php echo h($diceRoll['DiceRoll']['modifier']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($diceRoll['Skill']['skill_name'], array('controller' => 'skills', 'action' => 'view', $diceRoll['Skill']['id'])); ?>
		</td>
		<td><?php echo h($diceRoll['DiceRoll']['skill_level']); ?>&nbsp;</td>
		<td><?php echo h($diceRoll['DiceRoll']['fate_spent']); ?>&nbsp;</td>
		<td><?php echo h($diceRoll['DiceRoll']['aspects_tagged']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($diceRoll['CreatedBy']['username'], array('controller' => 'users', 'action' => 'view', $diceRoll['CreatedBy']['user_id'])); ?>
		</td>
		<td><?php echo h($diceRoll['DiceRoll']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $diceRoll['DiceRoll']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $diceRoll['DiceRoll']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $diceRoll['DiceRoll']['id']), null, __('Are you sure you want to delete # %s?', $diceRoll['DiceRoll']['id'])); ?>
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
