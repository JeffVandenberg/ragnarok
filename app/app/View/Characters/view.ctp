<div class="characters view">
<h2><?php  echo __('Character'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($character['Character']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Game'); ?></dt>
		<dd>
			<?php echo $this->Html->link($character['Game']['id'], array('controller' => 'games', 'action' => 'view', $character['Game']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Character Name'); ?></dt>
		<dd>
			<?php echo h($character['Character']['character_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Power Level'); ?></dt>
		<dd>
			<?php echo h($character['Character']['power_level']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Max Fate'); ?></dt>
		<dd>
			<?php echo h($character['Character']['max_fate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Current Fate'); ?></dt>
		<dd>
			<?php echo h($character['Character']['current_fate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Character Status'); ?></dt>
		<dd>
			<?php echo $this->Html->link($character['CharacterStatus']['name'], array('controller' => 'character_statuses', 'action' => 'view', $character['CharacterStatus']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo $this->Html->link($character['CreatedBy']['user_name'], array('controller' => 'users', 'action' => 'view', $character['CreatedBy']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($character['Character']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated By'); ?></dt>
		<dd>
			<?php echo $this->Html->link($character['UpdatedBy']['user_name'], array('controller' => 'users', 'action' => 'view', $character['UpdatedBy']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($character['Character']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Character'), array('action' => 'edit', $character['Character']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Character'), array('action' => 'delete', $character['Character']['id']), null, __('Are you sure you want to delete # %s?', $character['Character']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Characters'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Character'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Games'), array('controller' => 'games', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Game'), array('controller' => 'games', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Character Statuses'), array('controller' => 'character_statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Character Status'), array('controller' => 'character_statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Created By'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Character Aspects'), array('controller' => 'character_aspects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Character Aspect'), array('controller' => 'character_aspects', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Character Powers'), array('controller' => 'character_powers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Character Power'), array('controller' => 'character_powers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Character Skills'), array('controller' => 'character_skills', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Character Skill'), array('controller' => 'character_skills', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Character Stunts'), array('controller' => 'character_stunts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Character Stunt'), array('controller' => 'character_stunts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Story Characters'), array('controller' => 'story_characters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Story Character'), array('controller' => 'story_characters', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Character Aspects'); ?></h3>
	<?php if (!empty($character['CharacterAspect'])): ?>
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
		foreach ($character['CharacterAspect'] as $characterAspect): ?>
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
<div class="related">
	<h3><?php echo __('Related Character Powers'); ?></h3>
	<?php if (!empty($character['CharacterPower'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Character Id'); ?></th>
		<th><?php echo __('Power Id'); ?></th>
		<th><?php echo __('Refresh Cost'); ?></th>
		<th><?php echo __('Note'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($character['CharacterPower'] as $characterPower): ?>
		<tr>
			<td><?php echo $characterPower['id']; ?></td>
			<td><?php echo $characterPower['character_id']; ?></td>
			<td><?php echo $characterPower['power_id']; ?></td>
			<td><?php echo $characterPower['refresh_cost']; ?></td>
			<td><?php echo $characterPower['note']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'character_powers', 'action' => 'view', $characterPower['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'character_powers', 'action' => 'edit', $characterPower['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'character_powers', 'action' => 'delete', $characterPower['id']), null, __('Are you sure you want to delete # %s?', $characterPower['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Character Power'), array('controller' => 'character_powers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Character Skills'); ?></h3>
	<?php if (!empty($character['CharacterSkill'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Character Id'); ?></th>
		<th><?php echo __('Skill Id'); ?></th>
		<th><?php echo __('Skill Level'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($character['CharacterSkill'] as $characterSkill): ?>
		<tr>
			<td><?php echo $characterSkill['id']; ?></td>
			<td><?php echo $characterSkill['character_id']; ?></td>
			<td><?php echo $characterSkill['skill_id']; ?></td>
			<td><?php echo $characterSkill['skill_level']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'character_skills', 'action' => 'view', $characterSkill['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'character_skills', 'action' => 'edit', $characterSkill['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'character_skills', 'action' => 'delete', $characterSkill['id']), null, __('Are you sure you want to delete # %s?', $characterSkill['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Character Skill'), array('controller' => 'character_skills', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Character Stunts'); ?></h3>
	<?php if (!empty($character['CharacterStunt'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Character Id'); ?></th>
		<th><?php echo __('Stunt Id'); ?></th>
		<th><?php echo __('Note'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($character['CharacterStunt'] as $characterStunt): ?>
		<tr>
			<td><?php echo $characterStunt['id']; ?></td>
			<td><?php echo $characterStunt['character_id']; ?></td>
			<td><?php echo $characterStunt['stunt_id']; ?></td>
			<td><?php echo $characterStunt['note']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'character_stunts', 'action' => 'view', $characterStunt['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'character_stunts', 'action' => 'edit', $characterStunt['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'character_stunts', 'action' => 'delete', $characterStunt['id']), null, __('Are you sure you want to delete # %s?', $characterStunt['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Character Stunt'), array('controller' => 'character_stunts', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Story Characters'); ?></h3>
	<?php if (!empty($character['StoryCharacter'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Character Id'); ?></th>
		<th><?php echo __('Story Id'); ?></th>
		<th><?php echo __('Used Milestone'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($character['StoryCharacter'] as $storyCharacter): ?>
		<tr>
			<td><?php echo $storyCharacter['id']; ?></td>
			<td><?php echo $storyCharacter['character_id']; ?></td>
			<td><?php echo $storyCharacter['story_id']; ?></td>
			<td><?php echo $storyCharacter['used_milestone']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'story_characters', 'action' => 'view', $storyCharacter['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'story_characters', 'action' => 'edit', $storyCharacter['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'story_characters', 'action' => 'delete', $storyCharacter['id']), null, __('Are you sure you want to delete # %s?', $storyCharacter['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Story Character'), array('controller' => 'story_characters', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
