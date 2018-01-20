<?php /* @var View $this */ ?>
<?php /* @var array $permissions */ ?>

<?php $this->set('title_for_layout', 'Edit Permissions for: ' . $this->request->data['User']['username']); ?>
<h2><?php echo __('Edit Permissions for ') . $this->request->data['User']['username']; ?></h2>
<?php echo $this->Form->create('User'); ?>
<?php echo $this->Form->input('user_id'); ?>
<?php echo $this->Form->input('Permission', array(
    'label' => false,
    'type' => 'select',
    'multiple' => 'checkbox'
)); ?>
<?php echo $this->Form->submit(__('Save Permissions'), array('name' => 'action')); ?>
<?php echo $this->Form->submit(__('Cancel'), array('name' => 'action', 'formnovalidate' => true)); ?>
<?php echo $this->Form->end(); ?>