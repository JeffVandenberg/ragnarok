<?php /* @var View $this */ ?>
<?php /* @var Character[] $characters */ ?>
<?php $this->Paginator->options(array(
    'update' => '#page-content',
    'evalScripts' => true
)); ?>
<div class="characters index" id="page-content">
    <h2><?php echo __('Characters'); ?></h2>
    <table>
        <tr>
            <th><?php echo $this->Paginator->sort('character_name', 'Name'); ?></th>
            <th><?php echo $this->Paginator->sort('character_status_id', 'Status'); ?></th>
            <th><?php echo $this->Paginator->sort('updated_by_id'); ?></th>
            <th><?php echo $this->Paginator->sort('updated'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($characters as $character): ?>
            <tr>
                <td><?php echo h($character['Character']['character_name']); ?>&nbsp;</td>
                <td>
                    <?php echo h($character['CharacterStatus']['name']); ?>
                </td>
                <td>
                    <?php echo h($character['UpdatedBy']['username']); ?>
                </td>
                <td><?php echo h($character['Character']['updated']); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $character['Character']['id'])); ?>
                    <?php echo $this->Html->Link(__('Tools'), array('action' => 'tools', $character['Character']['id'])); ?>
                    <?php echo $this->Html->link(__('Public'), array('action' => 'publicView', $character['Character']['id'])); ?>
                    <?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $character['Character']['id']), null, __('Are you sure you want to delete # %s?', $character['Character']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="paging">
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?>
        <p>
        <?php
        echo $this->Paginator->prev('< ' . __('Previous'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('Next') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
        </p>
    </div>
</div>
<?php $this->start('context-navigation'); ?>
    <div class="context-group">
        <h3><?php echo __('Actions'); ?></h3>
        <ul>
            <li><?php echo $this->Html->link(__('New Character'), array('action' => 'add')); ?></li>
        </ul>
    </div>
<?php $this->end(); ?>
