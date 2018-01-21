<?php

use App\Model\Entity\User;
use App\View\AppView;

/* @var AppView $this */
/* @var array $actions */
/* @var User $user */

$this->set('title_for_layout', __('Power') . ': ' . h($user->username)); ?>

    <div class="users view">
        <h2><?php echo __('User'); ?>: <?php echo h($user->username); ?></h2>
        <dl>
            <dt><?php echo __('User Ip'); ?></dt>
            <dd>
                <?php echo h($user->user_ip); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('User Regdate'); ?></dt>
            <dd>
                <?php echo $this->Time->format($user->user_regdate); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('User Email'); ?></dt>
            <dd>
                <?php echo h($user->user_email); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('User Lastvisit'); ?></dt>
            <dd>
                <?php echo $this->Time->format($user->user_lastvisit); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('User Lastpage'); ?></dt>
            <dd>
                <?php echo h($user->user_lastpage); ?>
            </dd>
        </dl>
    </div>
<h3><?php echo __('Permissions'); ?></h3>
<?php if (!empty($user->permissions)): ?>
<table>
    <?php
    foreach ($user->permissions as $permission): ?>
        <tr>
            <td><?php echo $permission->permission_name; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
    None
<?php endif; ?>

<?php $this->start('context-navigation'); ?>
    <div class="context-group">
        <h3><?php echo __('Actions'); ?></h3>
        <ul>
            <li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
            <li><?php echo $this->Html->link(__('Edit Permissions'), array('action' => 'editPermissions', $user->user_id)); ?> </li>
        </ul>
    </div>
<?php $this->end(); ?>
