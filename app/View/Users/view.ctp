<?php /* @var View $this */ ?>
<?php /* @var array $actions */ ?>
<?php /* @var array $user */ ?>
<?php $this->set('title_for_layout', __('Power') . ': ' . h($user['User']['username'])); ?>

    <div class="users view">
        <h2><?php echo __('User'); ?>: <?php echo h($user['User']['username']); ?></h2>
        <dl>
            <dt><?php echo __('User Ip'); ?></dt>
            <dd>
                <?php echo h($user['User']['user_ip']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('User Regdate'); ?></dt>
            <dd>
                <?php echo date('Y-m-d', $user['User']['user_regdate']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('User Email'); ?></dt>
            <dd>
                <?php echo h($user['User']['user_email']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('User Birthday'); ?></dt>
            <dd>
                <?php echo h($user['User']['user_birthday']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('User Lastvisit'); ?></dt>
            <dd>
                <?php echo date('Y-m-d', $user['User']['user_lastvisit']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('User Lastpage'); ?></dt>
            <dd>
                <?php echo h($user['User']['user_lastpage']); ?>
                &nbsp;
            </dd>
        </dl>
    </div>
<h3><?php echo __('Permissions'); ?></h3>
<?php if (!empty($user['Permission'])): ?>
<table>
    <?php
    foreach ($user['Permission'] as $permission): ?>
        <tr>
            <td><?php echo $permission['permission_name']; ?></td>
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
            <li><?php echo $this->Html->link(__('Edit Permissions'), array('action' => 'editPermissions', $user['User']['user_id'])); ?> </li>
        </ul>
    </div>
<?php $this->end(); ?>