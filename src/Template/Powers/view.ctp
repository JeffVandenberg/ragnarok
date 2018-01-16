<?php

use App\Model\Entity\Power;
use App\View\AppView;

/* @var AppView $this */
/* @var array $actions */
/* @var Power $power */

$this->set('title_for_layout', __('Power') . ': ' . h($power->power_name));
?>

    <div class="powers view">
        <h2><?php echo __('Power'); ?>: <?php echo h($power->power_name); ?></h2>
        <dl>
            <dt><?php echo __('Description'); ?></dt>
            <dd>
                <?php echo h($power->description); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Cost'); ?></dt>
            <dd>
                <?php echo h($power->cost); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Is Official'); ?></dt>
            <dd>
                <?php echo ($power->is_official) ? __('Yes') : __('No'); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Is Approved'); ?></dt>
            <dd>
                <?php echo ($power->is_approved) ? __('Yes') : __('No'); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Created By'); ?></dt>
            <dd>
                <?php echo h($power->created_by->username); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Created'); ?></dt>
            <dd>
                <?php echo h($power->created); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Updated By'); ?></dt>
            <dd>
                <?php echo h($power->updated_by->username); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Updated'); ?></dt>
            <dd>
                <?php echo h($power->updated); ?>
                &nbsp;
            </dd>
        </dl>
    </div>
<?php $this->start('context-navigation'); ?>
    <div class="context-group">
        <h3><?php echo __('Actions'); ?></h3>
        <ul>
            <li><?php echo $this->Html->link(__('List Powers'), array('action' => 'index')); ?> </li>
            <?php if (isset($actions['add'])): ?>
                <li><?php echo $this->Html->link(__('Add Power'), array('action' => 'add')); ?> </li>
            <?php endif; ?>
            <?php if (isset($actions['edit'])): ?>
                <li><?php echo $this->Html->link(__('Edit Power'), array('action' => 'edit', $power->id)); ?> </li>
                <li><?php echo $this->Form->postLink(__('Delete Power'), array('action' => 'delete', $power->id), ['confirm' => __('Are you sure you want to delete ' . $power->power_name . '?')]); ?> </li>
            <?php endif; ?>
        </ul>
    </div>
<?php $this->end(); ?>
