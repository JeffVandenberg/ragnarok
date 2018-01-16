<?php

use App\Model\Entity\Stunt;
use App\View\AppView;

/* @var AppView $this */
/* @var Stunt $stunt */
/* @var boolean $isAjax */
/* @var boolean $showAdmin */

$this->set('title_for_layout', 'Add Stunt');
?>
<div class="stunts form">
    <?php
    echo $this->Form->create($stunt);
    ?>
    <?php if (!$isAjax): ?>
        <h3><?php echo __('Add Stunt'); ?></h3>
    <?php endif; ?>
    <?php
    echo $this->Form->control('stunt_name');
    echo $this->Form->control('cost');
    echo $this->Form->control('skill_id');
    echo $this->Form->control('stunt_rules', array('style' => 'width: 100%', 'rows' => '10'));
    if ($showAdmin) {
        echo $this->Form->control('is_official');
        echo $this->Form->control('is_approved');
    }
    if (!$isAjax) {
        echo $this->Form->submit(__('Submit'), array('name' => 'action'));
        echo $this->Form->submit(__('Cancel'), array('name' => 'action', 'formnovalidate' => true));
    }
    echo $this->Form->end();
    ?>
</div>
