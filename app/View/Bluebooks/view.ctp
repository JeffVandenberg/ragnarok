<?php /* @var array $bluebook */ ?>
<?php /* @var View $this */ ?>
<?php $this->set('title_for_layout', 'Bluebook Entry: ' . $bluebook['title']); ?>
    <div class="bluebooks view">
        <h2><?php echo __('Bluebook entry: ') . $bluebook['Bluebook']['title']; ?></h2>
        <dl>
            <dt><?php echo __('Status'); ?></dt>
            <dd>
                <?php echo h($bluebook['BluebookStatus']['name']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Body'); ?></dt>
            <dd>
                <?php echo $bluebook['Bluebook']['body']; ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Created'); ?></dt>
            <dd>
                <?php echo h($bluebook['Bluebook']['created']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Updated'); ?></dt>
            <dd>
                <?php echo h($bluebook['Bluebook']['updated']); ?>
                &nbsp;
            </dd>
        </dl>
    </div>
<?php $this->start('context-navigation'); ?>
    <div class="context-group">
        <h3><?php echo __('Actions'); ?></h3>
        <ul>
            <li><?php echo $this->Html->link(__('New Entry'), array('action' => 'add', $bluebook['Bluebook']['character_id'])); ?></li>
            <?php if ($bluebook['Bluebook']['bluebook_status_id'] == BluebookStatus::NewEntry): ?>
                <li><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $bluebook['Bluebook']['id'])); ?></li>
                <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $bluebook['Bluebook']['id']), null, __('Are you sure you want to delete %s?', $bluebook['Bluebook']['title'])); ?></li>
            <?php endif; ?>
        </ul>
    </div>
<?php $this->end(); ?>