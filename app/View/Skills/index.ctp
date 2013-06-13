<?php /* @var View $this */ ?>
<?php /* @var array $skills */ ?>
<?php $this->Paginator->options(array(
    'update' => '#page-content',
    'evalScripts' => true
)); ?>

    <div class="skills index" id="page-content">
        <h2><?php echo __('Skills'); ?></h2>
        <table>
            <tr>
                <th><?php echo $this->Paginator->sort('skill_name'); ?></th>
                <th><?php echo $this->Paginator->sort('is_official'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
            <?php foreach ($skills as $skill): ?>
                <tr>
                    <td><?php echo h($skill['Skill']['skill_name']); ?>&nbsp;</td>
                    <td><?php echo ($skill['Skill']['is_official']) ? __('Yes') : __('No'); ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('action' => 'view', $skill['Skill']['id'])); ?>
                        <?php if (isset($actions['edit'])): ?>
                            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $skill['Skill']['id'])); ?>
                            <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $skill['Skill']['id']), null, __('Are you sure you want to delete # %s?', $skill['Skill']['id'])); ?>
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
            <li><?php echo $this->Html->link(__('New Skill'), array('action' => 'add')); ?></li>
        </ul>
    </div>
    <?php $this->end(); ?>
<?php endif; ?>