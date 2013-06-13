<?php /* @var View $this */ ?>
<?php /* @var array $stunts */ ?>

<?php $this->Paginator->options(array(
    'update' => '#page-content',
    'evalScripts' => true
)); ?>

    <div class="stunts index" id="page-content">
        <h2><?php echo __('Stunts'); ?></h2>
        <table>
            <tr>
                <th><?php echo $this->Paginator->sort('stunt_name'); ?></th>
                <th><?php echo $this->Paginator->sort('cost'); ?></th>
                <th><?php echo $this->Paginator->sort('skill_id'); ?></th>
                <th><?php echo $this->Paginator->sort('is_official'); ?></th>
                <th><?php echo $this->Paginator->sort('is_approved'); ?></th>
                <th><?php echo $this->Paginator->sort('created_by_id'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
            <?php foreach ($stunts as $stunt): ?>
                <tr>
                    <td><?php echo h($stunt['Stunt']['stunt_name']); ?>&nbsp;</td>
                    <td><?php echo h($stunt['Stunt']['cost']); ?>&nbsp;</td>
                    <td>
                        <?php echo $this->Html->link($stunt['Skill']['skill_name'], array('controller' => 'skills', 'action' => 'view', $stunt['Skill']['id'])); ?>
                    </td>
                    <td><?php echo ($stunt['Stunt']['is_official']) ? __('Yes') : __('No'); ?>&nbsp;</td>
                    <td><?php echo ($stunt['Stunt']['is_approved']) ? __('Yes') : __('No'); ?>&nbsp;</td>
                    <td>
                        <?php echo h($stunt['CreatedBy']['username']); ?>
                    </td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('action' => 'view', $stunt['Stunt']['id'])); ?>
                        <?php if (isset($actions['edit'])): ?>
                            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $stunt['Stunt']['id'])); ?>
                            <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $stunt['Stunt']['id']), null, __('Are you sure you want to delete # %s?', $stunt['Stunt']['id'])); ?>
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
            <li><?php echo $this->Html->link(__('New Stunt'), array('action' => 'add')); ?></li>
        </ul>
    </div>
    <?php $this->end(); ?>
<?php endif; ?>