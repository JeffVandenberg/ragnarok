<?php $this->set('title_for_layout', 'Add Skill'); ?>

<div class="skills form">
    <?php echo $this->Form->create('Skill'); ?>
    <h3><?php echo __('Add Skill'); ?></h3>
    <?php
    echo $this->Form->input('skill_name');
    echo $this->Form->input('is_official');
    echo $this->Form->submit(__('Submit'), array('name' => 'action'));
    echo $this->Form->submit(__('Cancel'), array('name' => 'action', 'formnovalidate' => true));
    ?>
    <?php echo $this->Form->end(); ?>
</div>