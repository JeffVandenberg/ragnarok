<div class="aspectTypes form">
<?php echo $this->Form->create('AspectType'); ?>
	<fieldset>
		<legend><?php echo __('Edit Aspect Type'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('AspectType.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('AspectType.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Aspect Types'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Character Aspects'), array('controller' => 'character_aspects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Character Aspect'), array('controller' => 'character_aspects', 'action' => 'add')); ?> </li>
	</ul>
</div>
