<?php /* @var View $this */ ?>
<?php $this->set('title_for_layout', __('Edit') . ': ' . $this->request->data['Stunt']['stunt_name']); ?>

<div class="stunts form">
<?php echo $this->Form->create('Stunt'); ?>
    <h3><?php echo __('Edit Stunt'); ?></h3>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('stunt_name');
		echo $this->Form->input('cost');
		echo $this->Form->input('skill_id');
		echo $this->Form->input('stunt_rules', array('style' => 'width: 100%', 'rows' => '10'));
		echo $this->Form->input('is_official');
		echo $this->Form->input('is_approved');
        echo $this->Form->submit(__('Submit'), array('name' => 'action'));
        echo $this->Form->submit(__('Cancel'), array('name' => 'action', 'formnovalidate' => true));
    ?>
    <?php echo $this->Form->end(); ?>
</div>