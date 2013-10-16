<?php /* @var View $this */ ?>
<?php /* @var array $request */ ?>
<?php $this->set('title_for_layout', $request['RagRequest']['title']); ?>

    <div class="requests view">
        <h2><?php echo $request['RagRequest']['title']; ?></h2>
        <dl>
            <dt><?php echo __('Title'); ?></dt>
            <dd>
                <?php echo h($request['RagRequest']['title']); ?>
            </dd>
            <dt><?php echo __('Body'); ?></dt>
            <dd>
                <?php echo $request['RagRequest']['body']; ?>
            </dd>
            <dt><?php echo __('Request Type'); ?></dt>
            <dd>
                <?php echo h($request['RequestType']['name']); ?>
            </dd>
            <dt><?php echo __('Request Status'); ?></dt>
            <dd>
                <?php echo h($request['RequestStatus']['name']); ?>
            </dd>
            <dt><?php echo __('Created By'); ?></dt>
            <dd>
                <?php echo h($request['CreatedBy']['username']); ?>
            </dd>
            <dt><?php echo __('Created On'); ?></dt>
            <dd>
                <?php echo h($request['RagRequest']['created']); ?>
            </dd>
            <dt><?php echo __('Updated By'); ?></dt>
            <dd>
                <?php echo h($request['UpdatedBy']['username']); ?>
            </dd>
            <dt><?php echo __('Updated On'); ?></dt>
            <dd>
                <?php echo h($request['RagRequest']['updated']); ?>
            </dd>
        </dl>
    </div>
<?php if (count($request['RequestNote'])): ?>
    <h3><?php echo __('Notes'); ?></h3>
    <?php foreach ($request['RequestNote'] as $requestNote): ?>
        <div class="request-body">
            <div>
                <?php echo $requestNote['note']; ?>
            </div>
            <div class="request-detail">
                By: <?php echo $requestNote['CreatedBy']['username']; ?>
                On: <?php echo date('m/d/Y H:i:s', strtotime($requestNote['created'])); ?>
            </div>
        </div>
    <?php endforeach; ?>
    <br />
<?php endif; ?>
<?php if (count($request['RequestBluebook'])): ?>
    <h3><?php echo __('Bluebook Entries'); ?></h3>
    <?php foreach ($request['RequestBluebook'] as $requestBluebook): ?>
        <div class="request-body">
            <div>
                <?php echo $this->Html->link($requestBluebook['Bluebook']['title'], array('controller' => 'bluebooks', 'action' => 'view', $requestBluebook['bluebook_id'])); ?>
            </div>
            <div class="request-detail">
                Created On: <?php echo date('m/d/Y H:i:s', strtotime($requestBluebook['Bluebook']['created'])); ?>
            </div>
        </div>
    <?php endforeach; ?>
    <br />
<?php endif; ?>
<?php $this->start('context-navigation'); ?>
    <div class="context-group">
        <h3><?php echo __('Actions'); ?></h3>
        <ul>
            <li><?php echo $this->Html->link(__('Add Note'), array('action' => 'addNote', $request['RagRequest']['id'])); ?></li>
            <li><?php echo $this->Html->link(__('Add Bluebook'), array('action' => 'addBluebook', $request['RagRequest']['id'])); ?></li>
            <li><?php echo $this->Html->link(__('Add Request'), array('action' => 'addRequest', $request['RagRequest']['id'])); ?></li>
            <li><?php echo $this->Html->link(__('Add Character'), array('action' => 'addCharacter', $request['RagRequest']['id'])); ?></li>
            <li><?php echo $this->Html->link(__('Submit'), array('action' => 'submit', $request['RagRequest']['id'])); ?></li>
            <li><?php echo $this->Html->link(__('Close'), array('action' => 'close', $request['RagRequest']['id'])); ?></li>
            <li><?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $request['RagRequest']['id'])); ?></li>
        </ul>
    </div>
<?php $this->end(); ?>