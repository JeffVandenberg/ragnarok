<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Power $power
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $power->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $power->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Powers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Character Powers'), ['controller' => 'CharacterPowers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Character Power'), ['controller' => 'CharacterPowers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Template Powers'), ['controller' => 'TemplatePowers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Template Power'), ['controller' => 'TemplatePowers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="powers form large-9 medium-8 columns content">
    <?= $this->Form->create($power) ?>
    <fieldset>
        <legend><?= __('Edit Power') ?></legend>
        <?php
            echo $this->Form->control('power_name');
            echo $this->Form->control('description');
            echo $this->Form->control('cost');
            echo $this->Form->control('is_official');
            echo $this->Form->control('is_approved');
            echo $this->Form->control('created_by_id');
            echo $this->Form->control('updated_by_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
