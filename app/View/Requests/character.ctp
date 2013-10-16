<?php /* @var View $this */ ?>
<?php /* @var array $character */ ?>
<?php /* @var array $requests */ ?>
<?php $this->set('title_for_layout', __('Requests for ') . $character['Character']['character_name']); ?>
<div class="requests index">
    <h2><?php echo __('Requests for ') . $character['Character']['character_name']; ?></h2>
    <table>
        <tr>
            <th><?php echo $this->Paginator->sort('title'); ?></th>
            <th><?php echo $this->Paginator->sort('RequestType.name', 'Type'); ?></th>
            <th><?php echo $this->Paginator->sort('RequestStatus.name', 'Name'); ?></th>
            <th><?php echo $this->Paginator->sort('created_on'); ?></th>
            <th><?php echo $this->Paginator->sort('UpdatedBy.username', 'Updated By'); ?></th>
            <th><?php echo $this->Paginator->sort('updated_on'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($requests as $request): ?>
            <tr>
                <td><?php echo h($request['RagRequest']['title']); ?>&nbsp;</td>
                <td>
                    <?php echo h($request['RequestType']['name']); ?>
                </td>
                <td>
                    <?php echo h($request['RequestStatus']['name']); ?>
                </td>
                <td><?php echo h($request['RagRequest']['created']); ?>&nbsp;</td>
                <td>
                    <?php echo h($request['UpdatedBy']['username']); ?>
                </td>
                <td><?php echo h($request['RagRequest']['updated']); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $request['RagRequest']['id'])); ?>
                    <?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $request['RagRequest']['id'])); ?>
                    <?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $request['RagRequest']['id']), null, __('Are you sure you want to delete # %s?', $request['RagRequest']['id'])); ?>
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
            <li><?php echo $this->Html->link(__('New Request'), array('action' => 'add', $character['Character']['id'])); ?></li>
        </ul>
    </div>
<?php $this->end(); ?>