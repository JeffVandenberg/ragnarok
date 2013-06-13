<?php /* @var View $this */ ?>
<?php /* @var array $actions */ ?>
<?php /* @var array $power */ ?>
<?php $this->set('title_for_layout', __('Power') . ': ' . h($power['Power']['power_name'])); ?>

    <div class="powers view">
        <h2><?php echo __('Power'); ?>: <?php echo h($power['Power']['power_name']); ?></h2>
        <dl>
            <dt><?php echo __('Description'); ?></dt>
            <dd>
                <?php echo h($power['Power']['description']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Cost'); ?></dt>
            <dd>
                <?php echo h($power['Power']['cost']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Is Official'); ?></dt>
            <dd>
                <?php echo ($power['Power']['is_official']) ? __('Yes') : __('No'); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Is Approved'); ?></dt>
            <dd>
                <?php echo ($power['Power']['is_approved']) ? __('Yes') : __('No'); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Created By'); ?></dt>
            <dd>
                <?php echo h($power['CreatedBy']['username']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Created'); ?></dt>
            <dd>
                <?php echo h($power['Power']['created']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Updated By'); ?></dt>
            <dd>
                <?php echo h($power['UpdatedBy']['username']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Updated'); ?></dt>
            <dd>
                <?php echo h($power['Power']['updated']); ?>
                &nbsp;
            </dd>
        </dl>
    </div>
<?php $this->start('context-navigation'); ?>
    <div class="context-group">
        <h3><?php echo __('Actions'); ?></h3>
        <ul>
            <li><?php echo $this->Html->link(__('List Powers'), array('action' => 'index')); ?> </li>
            <?php if (isset($actions['add'])): ?>
                <li><?php echo $this->Html->link(__('Add Power'), array('action' => 'add')); ?> </li>
            <?php endif; ?>
            <?php if (isset($actions['edit'])): ?>
                <li><?php echo $this->Html->link(__('Edit Power'), array('action' => 'edit', $power['Power']['id'])); ?> </li>
                <li><?php echo $this->Form->postLink(__('Delete Power'), array('action' => 'delete', $power['Power']['id']), null, __('Are you sure you want to delete # %s?', $power['Power']['id'])); ?> </li>
            <?php endif; ?>
        </ul>
    </div>
<?php $this->end(); ?>