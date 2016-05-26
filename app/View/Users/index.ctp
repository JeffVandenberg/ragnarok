<?php /* @var View $this */ ?>
<?php /* @var array $users */ ?>
<?php $this->Paginator->options(array(
    'update' => '#page-content',
    'evalScripts' => true
)); ?>

<div class="users index" id="page-content">
    <h2><?php echo __('Users'); ?></h2>
    <table>
        <tr>
            <th><?php echo $this->Paginator->sort('user_type'); ?></th>
            <th><?php echo $this->Paginator->sort('group_id'); ?></th>
            <th><?php echo $this->Paginator->sort('username_clean', 'Username'); ?></th>
            <th><?php echo $this->Paginator->sort('user_email'); ?></th>
            <th><?php echo $this->Paginator->sort('user_lastvisit'); ?></th>
            <th><?php echo $this->Paginator->sort('user_rank'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo h($user['User']['user_type']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['group_id']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['user_email']); ?>&nbsp;</td>
                <td><?php echo ($user['User']['user_lastvisit']) ? date('Y-m-d', $user['User']['user_lastvisit']) : ''; ?>
                    &nbsp;</td>
                <td><?php echo h($user['User']['user_rank']); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['user_id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?>
    </p>

    <div class="paging">
        <ul class="pagination" role="navigation" aria-label="Pagination">
            <?php
            echo $this->Paginator->prev(
                __('Previous'),
                [
                    'class' => 'pagination-previous',
                    'tag' => 'li'
                ],
                null,
                [
                    'class' => 'prev disabled',
                    'tag' => 'li'
                ]
            );
            echo $this->Paginator->numbers([
                'before' => false,
                'after' => false,
                'tag' => 'li',
                'separator' => ''
            ]);
            echo $this->Paginator->next(
                __('Next'),
                [
                    'class' => 'pagination-next',
                    'tag' => 'li'
                ],
                null,
                [
                    'class' => 'next disabled',
                    'tag' => 'li'
                ]);
            ?>
        </ul>
    </div>
</div>
<?php $this->start('context-navigation'); ?>
<div class="context-group">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('List Permissions'), array('controller' => 'permissions', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Permission'), array('controller' => 'permissions', 'action' => 'add')); ?> </li>
    </ul>
</div>
<?php $this->end(); ?>
