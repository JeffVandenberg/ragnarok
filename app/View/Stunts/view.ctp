<?php /* @var View $this */ ?>
<?php /* @var array $actions */ ?>
<?php /* @var array $stunt */ ?>
<?php /* @var bool $isAjax */ ?>
<?php /* @var bool $isGm */ ?>
<?php $this->set('title_for_layout', __('Stunt') . ': ' . h($stunt['Stunt']['stunt_name'])); ?>

<div class="stunts view">
<h2><?php  echo __('Stunt'); ?>: <?php echo h($stunt['Stunt']['stunt_name']); ?></h2>
	<dl>
		<dt><?php echo __('Cost'); ?></dt>
		<dd>
			<?php echo h($stunt['Stunt']['cost']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Skill'); ?></dt>
		<dd>
            <?php if($isAjax): ?>
                <?php echo $this->Html->link($stunt['Skill']['skill_name'], array('controller' => 'skills', 'action' => 'view', $stunt['Skill']['id']), array('target' => '_blank')); ?>
            <?php else: ?>
			<?php echo $this->Html->link($stunt['Skill']['skill_name'], array('controller' => 'skills', 'action' => 'view', $stunt['Skill']['id'])); ?>
            <?php endif; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Stunt Rules'); ?></dt>
		<dd>
			<?php echo h($stunt['Stunt']['stunt_rules']); ?>
		</dd>
		<dt><?php echo __('Is Official'); ?></dt>
		<dd>
			<?php echo($stunt['Stunt']['is_official']) ? __('Yes') : __('No'); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Approved'); ?></dt>
		<dd>
			<?php echo ($stunt['Stunt']['is_approved']) ? __('Yes') : __('No'); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo h($stunt['CreatedBy']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($stunt['Stunt']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated By'); ?></dt>
		<dd>
			<?php echo h($stunt['UpdatedBy']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($stunt['Stunt']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php $this->start('context-navigation'); ?>
<div class="context-group">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
        <li><?php echo $this->Html->link(__('List Stunts'), array('action' => 'index')); ?> </li>
        <?php if(isset($actions['add'])): ?>
            <li><?php echo $this->Html->link(__('Add Stunt'), array('action' => 'add')); ?> </li>
        <?php endif; ?>
        <?php if(isset($actions['edit'])): ?>
            <li><?php echo $this->Html->link(__('Edit Stunt'), array('action' => 'edit', $stunt['Stunt']['id'])); ?> </li>
            <li><?php echo $this->Form->postLink(__('Delete Stunt'), array('action' => 'delete', $stunt['Stunt']['id']), null, __('Are you sure you want to delete # %s?', $stunt['Stunt']['id'])); ?> </li>
        <?php endif; ?>
	</ul>
</div>
<?php $this->end(); ?>