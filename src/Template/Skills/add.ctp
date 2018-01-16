<?php
use App\Model\Entity\Skill;
use App\View\AppView;

/* @var AppView $this */
/* @var Skill $skill */

$this->set('title_for_layout', 'Add Skill');
?>

<div class="skills form">
    <?php echo $this->Form->create($skill); ?>
    <h3><?php echo __('Add Skill'); ?></h3>
    <?php
    echo $this->Form->control('skill_name');
    echo $this->Form->control('is_official');
    echo $this->Form->submit(__('Submit'), array('name' => 'action'));
    echo $this->Form->submit(__('Cancel'), array('name' => 'action', 'formnovalidate' => true));
    ?>
    <?php echo $this->Form->end(); ?>
</div>
