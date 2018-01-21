<?php

use App\Model\Entity\Permission;
use App\Model\Entity\User;
use App\View\AppView;

/* @var AppView $this */
/* @var Permission[] $permissions */
/* @var User $user */
$this->set('title_for_layout', 'Edit Permissions for: ' . $user->username);
?>
<h2><?php echo __('Edit Permissions for ') . $user->username ?></h2>
<?php echo $this->Form->create($user); ?>
<?php echo $this->Form->control('user_id'); ?>
<?php echo $this->Form->control('permissions._ids', array(
    'label' => false,
    'type' => 'select',
    'multiple' => 'checkbox'
)); ?>
<?php echo $this->Form->submit(__('Save Permissions'), array('name' => 'action')); ?>
<?php echo $this->Form->submit(__('Cancel'), array('name' => 'action', 'formnovalidate' => true)); ?>
<?php echo $this->Form->end(); ?>
