<?php /* @var View $this */ ?>
<?php /* @var array $powers */ ?>
<?php /* @var array $actions */ ?>
<?php $this->Paginator->options(array(
    'update' => '#page-content',
    'evalScripts' => true
)); ?>

<div class="powers index" id="page-content">
    <h2><?php echo __('Powers'); ?></h2>
    <table>
        <tr>
            <th><?php echo $this->Paginator->sort('power_name'); ?></th>
            <th><?php echo $this->Paginator->sort('cost'); ?></th>
            <th><?php echo $this->Paginator->sort('is_official'); ?></th>
            <th><?php echo $this->Paginator->sort('is_approved'); ?></th>
            <th><?php echo $this->Paginator->sort('created_by_id'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($powers as $power): ?>
            <tr>
                <td><?php echo h($power['Power']['power_name']); ?>&nbsp;</td>
                <td><?php echo h($power['Power']['cost']); ?>&nbsp;</td>
                <td><?php echo ($power['Power']['is_official']) ? 'Yes' : 'No'; ?>&nbsp;</td>
                <td><?php echo ($power['Power']['is_approved']) ? 'Yes' : 'No'; ?>&nbsp;</td>
                <td>
                    <?php echo h($power['CreatedBy']['username']); ?>
                </td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $power['Power']['id'])); ?>
                    <?php if(isset($actions['edit'])): ?>
                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $power['Power']['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $power['Power']['id']), null, __('Are you sure you want to delete # %s?', $power['Power']['id'])); ?>
                    <?php endif; ?>
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
        <?php
        echo $this->Paginator->prev('< ' . __('Previous'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => '', 'class' => 'item'));
        echo $this->Paginator->next(__('Next') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
    </div>
</div>
<?php if(isset($actions['add'])): ?>
    <?php $this->start('context-navigation'); ?>
    <div class="context-group">
        <h3><?php echo __('Actions'); ?></h3>
        <ul>
            <li><?php echo $this->Html->link(__('New Power'), array('action' => 'add')); ?></li>
        </ul>
    </div>
    <?php $this->end(); ?>
<?php endif; ?>
