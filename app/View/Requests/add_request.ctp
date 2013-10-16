<?php /* @var View $this */ ?>
<?php /* @var array $request */ ?>
<?php /* @var array $requests */ ?>
<?php $this->set('title_for_layout', __('Add Request to: ') . $request['RagRequest']['title']); ?>
    <h2><?php echo __('Add Request to: ') . $request['RagRequest']['title']; ?></h2>

<?php echo $this->Form->create(false); ?>
<?php echo $this->Form->select('request_id', $requests); ?><br />
<?php echo $this->Form->button('Add Request', array('name' => 'action', 'class' => 'button')); ?>
<?php echo $this->Form->button('Cancel', array('name' => 'action', 'class' => 'button')); ?>
<?php echo $this->Form->end(); ?>
