<?php /* @var View $this */ ?>
<?php /* @var array $request */ ?>
<?php $this->set('title_for_layout', __('Add bluebook entry to: ') . $request['RagRequest']['title']); ?>
<h2><?php echo __('Add Bluebook Entry to: ') . $request['RagRequest']['title']; ?></h2>

<?php echo $this->Form->create(false); ?>
<?php echo $this->Form->input('bluebook_id'); ?>
<?php echo $this->Form->submit('Add Entry', array('name' => 'action', 'class' => 'button')); ?>
<?php echo $this->Form->submit('Cancel', array('name' => 'action', 'class' => 'button')); ?>
<?php echo $this->Form->end(); ?>
