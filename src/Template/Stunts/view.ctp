<?php

use App\Model\Entity\Stunt;
use App\View\AppView;

/* @var AppView $this */
/* @var array $actions */
/* @var Stunt $stunt */
/* @var bool $isAjax */
/* @var bool $isGm */

$this->set('title_for_layout', __('Stunt') . ': ' . h($stunt->stunt_name));
?>

    <div class="stunts view">
        <h2><?php echo __('Stunt'); ?>: <?php echo h($stunt->stunt_name); ?></h2>
        <dl>
            <dt><?php echo __('Cost'); ?></dt>
            <dd>
                <?php echo h($stunt->cost); ?>
            </dd>
            <dt><?php echo __('Skill'); ?></dt>
            <dd>
                <?php if ($isAjax): ?>
                    <?php echo $this->Html->link($stunt->skill->skill_name, array('controller' => 'skills', 'action' => 'view', $stunt->skill_id), array('target' => '_blank')); ?>
                <?php else: ?>
                    <?php echo $this->Html->link($stunt->skill->skill_name, array('controller' => 'skills', 'action' => 'view', $stunt->skill_id)); ?>
                <?php endif; ?>
            </dd>
            <dt><?php echo __('Stunt Rules'); ?></dt>
            <dd>
                <?php echo $this->Text->autoParagraph(h($stunt->stunt_rules)); ?>
            </dd>
            <dt><?php echo __('Is Official'); ?></dt>
            <dd>
                <?php echo ($stunt->is_official) ? __('Yes') : __('No'); ?>
            </dd>
            <dt><?php echo __('Is Approved'); ?></dt>
            <dd>
                <?php echo ($stunt->is_approved) ? __('Yes') : __('No'); ?>
            </dd>
            <dt><?php echo __('Created By'); ?></dt>
            <dd>
                <?php echo h($stunt->created_by->username); ?>
            </dd>
            <dt><?php echo __('Created'); ?></dt>
            <dd>
                <?php echo h($stunt->created); ?>
            </dd>
            <dt><?php echo __('Updated By'); ?></dt>
            <dd>
                <?php echo h($stunt->updated_by->username); ?>
            </dd>
            <dt><?php echo __('Updated'); ?></dt>
            <dd>
                <?php echo h($stunt->updated); ?>
            </dd>
        </dl>
    </div>
<?php $this->start('context-navigation'); ?>
    <div class="context-group">
        <h3><?php echo __('Actions'); ?></h3>
        <ul>
            <li><?php echo $this->Html->link(__('List Stunts'), array('action' => 'index')); ?> </li>
            <?php if (isset($actions['add'])): ?>
                <li><?php echo $this->Html->link(__('Add Stunt'), array('action' => 'add')); ?> </li>
            <?php endif; ?>
            <?php if (isset($actions['edit'])): ?>
                <li><?php echo $this->Html->link(__('Edit Stunt'), array('action' => 'edit', $stunt->id)); ?> </li>
                <li><?php echo $this->Form->postLink(__('Delete Stunt'), array('action' => 'delete', $stunt->id), ['confirm' => __('Are you sure you want to delete ' . $stunt->stunt_name)]); ?> </li>
            <?php endif; ?>
        </ul>
    </div>
<?php $this->end(); ?>
