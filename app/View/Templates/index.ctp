<?php /* @var View $this */ ?>
<?php /* @var array $templates */ ?>
<?php $this->Paginator->options(array(
    'update' => '#page-content',
    'evalScripts' => true
)); ?>

    <div class="templates index" id="page-content">
        <h2><?php echo __('Templates'); ?></h2>
        <table>
            <tr>
                <th><?php echo $this->Paginator->sort('template_name'); ?></th>
                <th><?php echo $this->Paginator->sort('description'); ?></th>
                <th><?php echo $this->Paginator->sort('is_official'); ?></th>
                <th><?php echo $this->Paginator->sort('is_approved'); ?></th>
                <th><?php echo $this->Paginator->sort('created_by_id'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
            <?php foreach ($templates as $template): ?>
                <tr>
                    <td><?php echo h($template['Template']['template_name']); ?>&nbsp;</td>
                    <td><?php echo h($template['Template']['description']); ?>&nbsp;</td>
                    <td><?php echo ($template['Template']['is_official']) ? __('Yes') : __('No'); ?>&nbsp;</td>
                    <td><?php echo ($template['Template']['is_approved']) ? __('Yes') : __('No'); ?>&nbsp;</td>
                    <td>
                        <?php echo h($template['CreatedBy']['username']); ?>
                    </td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('action' => 'view', $template['Template']['id'])); ?>
                        <?php if (isset($actions['edit'])): ?>
                            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $template['Template']['id'])); ?>
                            <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $template['Template']['id']), null, __('Are you sure you want to delete # %s?', $template['Template']['id'])); ?>
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
            echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
            echo $this->Paginator->numbers(array('separator' => ''));
            echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
            ?>
        </div>
    </div>
<?php if (isset($actions['add'])): ?>
    <?php $this->start('context-navigation'); ?>
    <div class="context-group">
        <h3><?php echo __('Actions'); ?></h3>
        <ul>
            <li><?php echo $this->Html->link(__('New Template'), array('action' => 'add')); ?></li>
        </ul>
    </div>
    <?php $this->end(); ?>
<?php endif; ?>