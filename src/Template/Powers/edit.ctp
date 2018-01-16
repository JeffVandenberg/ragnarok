<?php

use App\Model\Entity\Power;
use App\View\AppView;

/* @var AppView $this */
/* @var Power $power */

$this->set('title_for_layout', __('Edit') . ': ' . $power->power_name); 
?>
<div class="powers form">
    <?php echo $this->Form->create($power); ?>
    <h3>
        <?php echo __('Edit Power'); ?>
    </h3>
    <?php
        echo $this->Form->control('id');
        echo $this->Form->control('power_name');
    ?>
    For official powers, please only provide a page number reference or url.
    <?php
        echo $this->Form->control('description', array('style' => 'width: 100%', 'rows' => '10'));
        echo $this->Form->control('cost');
        echo $this->Form->control('is_official');
        echo $this->Form->control('is_approved');
        echo $this->Form->submit(__('Submit'), array('name' => 'action'));
        echo $this->Form->submit(__('Cancel'), array('name' => 'action', 'formnovalidate' => true));
    ?>
    <?php echo $this->Form->end(); ?>
</div>
