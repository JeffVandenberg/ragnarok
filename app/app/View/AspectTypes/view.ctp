<div class="aspectTypes view">
<h2><?php  echo __('Aspect Type'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($aspectType['AspectType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($aspectType['AspectType']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Aspect Type'), array('action' => 'edit', $aspectType['AspectType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Aspect Type'), array('action' => 'delete', $aspectType['AspectType']['id']), null, __('Are you sure you want to delete # %s?', $aspectType['AspectType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Aspect Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Aspect Type'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Character Aspects'), array('controller' => 'character_aspects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Character Aspect'), array('controller' => 'character_aspects', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Character Aspects'); ?></h3>
	<?php if (!empty($aspectType['CharacterAspect'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Character Id'); ?></th>
		<th><?php echo __('Aspect Type Id'); ?></th>
		<th><?php echo __('Aspect Text'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Story Id'); ?></th>
		<th><?php echo __('Assoc Character Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($aspectType['CharacterAspect'] as $characterAspect): ?>
		<tr>
			<td><?php echo $characterAspect['id']; ?></td>
			<td><?php echo $characterAspect['character_id']; ?></td>
			<td><?php echo $characterAspect['aspect_type_id']; ?></td>
			<td><?php echo $characterAspect['aspect_text']; ?></td>
			<td><?php echo $characterAspect['description']; ?></td>
			<td><?php echo $characterAspect['story_id']; ?></td>
			<td><?php echo $characterAspect['assoc_character_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'character_aspects', 'action' => 'view', $characterAspect['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'character_aspects', 'action' => 'edit', $characterAspect['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'character_aspects', 'action' => 'delete', $characterAspect['id']), null, __('Are you sure you want to delete # %s?', $characterAspect['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Character Aspect'), array('controller' => 'character_aspects', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
