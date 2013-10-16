<?php /* @var View $this */ ?>
<?php /* @var array $character */ ?>
<?php /* @var array $bluebooks*/ ?>
<?php $this->set('title_for_layout', __('Bluebook Entries for ') . $character['Character']['character_name']); ?>
    <div class="bluebooks index">
        <h2><?php echo __('Bluebook Entries for ') . $character['Character']['character_name']; ?></h2>
        <table>
            <tr>
                <th><?php echo $this->Paginator->sort('title'); ?></th>
                <th><?php echo $this->Paginator->sort('BluebookStatus.name', 'Name'); ?></th>
                <th><?php echo $this->Paginator->sort('created'); ?></th>
                <th><?php echo $this->Paginator->sort('updated'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
            <?php foreach ($bluebooks as $bluebook): ?>
                <tr>
                    <td><?php echo h($bluebook['Bluebook']['title']); ?>&nbsp;</td>
                    <td>
                        <?php echo h($bluebook['BluebookStatus']['name']); ?>
                    </td>
                    <td><?php echo date('m/d/Y H:i:s', strtotime($bluebook['Bluebook']['created'])); ?>&nbsp;</td>
                    <td><?php echo date('m/d/Y H:i:s', strtotime($bluebook['Bluebook']['updated'])); ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('action' => 'view', $bluebook['Bluebook']['id'])); ?>
                        <?php if($bluebook['Bluebook']['bluebook_status_id'] == BluebookStatus::NewEntry): ?>
                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $bluebook['Bluebook']['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $bluebook['Bluebook']['id']), null, __('Are you sure you want to delete %s?', $bluebook['Bluebook']['title'])); ?>
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
            ?>	</p>
        <div class="paging">
            <?php
            echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
            echo $this->Paginator->numbers(array('separator' => ''));
            echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
            ?>
        </div>
    </div>
<?php $this->start('context-navigation'); ?>
    <div class="context-group">
        <h3><?php echo __('Actions'); ?></h3>
        <ul>
            <li><?php echo $this->Html->link(__('New Entry'), array('action' => 'add', $character['Character']['id'])); ?></li>
        </ul>
    </div>
<?php $this->end(); ?>