<?php

use App\Model\Entity\Skill;
use App\View\AppView;

/* @var AppView $this */
/* @var array $actions */
/* @var Skill $skill */

$this->set('title_for_layout', __('Skill') . ': ' . h($skill->skill_name));
?>

    <div class="skills view">
        <h2><?php echo __('Skill'); ?>: <?php echo h($skill->skill_name); ?></h2>
        <dl>
            <dt><?php echo __('Is Official'); ?></dt>
            <dd>
                <?php echo ($skill->is_official) ? __('Yes') : __('No'); ?>
                &nbsp;
            </dd>
        </dl>
    </div>

<?php $this->start('context-navigation'); ?>
    <div class="context-group">
        <h3><?php echo __('Actions'); ?></h3>
        <ul>
            <li><?php echo $this->Html->link(__('List Skills'), array('action' => 'index')); ?> </li>
            <?php if (isset($actions['add'])): ?>
                <li><?php echo $this->Html->link(__('Add Skill'), array('action' => 'add')); ?> </li>
            <?php endif; ?>
            <?php if (isset($actions['edit'])): ?>
                <li><?php echo $this->Html->link(__('Edit Skill'), array('action' => 'edit', $skill->id)); ?> </li>
                <li><?php echo $this->Form->postLink(__('Delete Skill'), array('action' => 'delete', $skill->id), ['confirm' => __('Are you sure you want to delete ' . $skill->skill_name)]); ?> </li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="context-group">
        <h3><?php echo __('Related Stunts'); ?></h3>
        <?php if (!empty($skill->stunts)): ?>
            <ul>
                <?php
                $i = 0;
                foreach ($skill->stunts as $stunt): ?>
                    <li><?php echo $this->Html->link($stunt->stunt_name, array('controller' => 'stunts', 'action' => 'view', $stunt->id)); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            None
        <?php endif; ?>
    </div>
<?php $this->end(); ?>
