<?php /* @var boolean $showAdmin */ ?>
<?php /* @var boolean $isAjax */ ?>

<?php $this->set('title_for_layout', 'Add Stunt'); ?>
<div class="stunts form">
    <?php echo $this->Form->create('Stunt'); ?>
    <?php if(!$isAjax): ?>
    <h3><?php echo __('Add Stunt'); ?></h3>
    <?php endif; ?>
    <?php
    echo $this->Form->input('stunt_name');
    echo $this->Form->input('cost');
    echo $this->Form->input('skill_id');
    echo $this->Form->input('stunt_rules', array('style' => 'width: 100%', 'rows' => '10'));
    ?>
    <?php
    if ($showAdmin) {
        echo $this->Form->input('is_official');
        echo $this->Form->input('is_approved');
    }
    ?>
    <?php
    if (!$isAjax) {
        echo $this->Form->submit(__('Submit'), array('name' => 'action'));
        echo $this->Form->submit(__('Cancel'), array('name' => 'action', 'formnovalidate' => true));
    }
    ?>
    <?php echo $this->Form->end(); ?>
</div>
