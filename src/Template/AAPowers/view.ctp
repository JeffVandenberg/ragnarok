<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Power $power
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Power'), ['action' => 'edit', $power->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Power'), ['action' => 'delete', $power->id], ['confirm' => __('Are you sure you want to delete # {0}?', $power->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Powers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Power'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Character Powers'), ['controller' => 'CharacterPowers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Character Power'), ['controller' => 'CharacterPowers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Template Powers'), ['controller' => 'TemplatePowers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Template Power'), ['controller' => 'TemplatePowers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="powers view large-9 medium-8 columns content">
    <h3><?= h($power->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Power Name') ?></th>
            <td><?= h($power->power_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($power->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cost') ?></th>
            <td><?= $this->Number->format($power->cost) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By Id') ?></th>
            <td><?= $this->Number->format($power->created_by_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated By Id') ?></th>
            <td><?= $this->Number->format($power->updated_by_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($power->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated') ?></th>
            <td><?= h($power->updated) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Official') ?></th>
            <td><?= $power->is_official ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Approved') ?></th>
            <td><?= $power->is_approved ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($power->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Character Powers') ?></h4>
        <?php if (!empty($power->character_powers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Character Id') ?></th>
                <th scope="col"><?= __('Power Id') ?></th>
                <th scope="col"><?= __('Refresh Cost') ?></th>
                <th scope="col"><?= __('Note') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($power->character_powers as $characterPowers): ?>
            <tr>
                <td><?= h($characterPowers->id) ?></td>
                <td><?= h($characterPowers->character_id) ?></td>
                <td><?= h($characterPowers->power_id) ?></td>
                <td><?= h($characterPowers->refresh_cost) ?></td>
                <td><?= h($characterPowers->note) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'CharacterPowers', 'action' => 'view', $characterPowers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'CharacterPowers', 'action' => 'edit', $characterPowers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'CharacterPowers', 'action' => 'delete', $characterPowers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $characterPowers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Template Powers') ?></h4>
        <?php if (!empty($power->template_powers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Template Id') ?></th>
                <th scope="col"><?= __('Power Id') ?></th>
                <th scope="col"><?= __('Power Cost') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($power->template_powers as $templatePowers): ?>
            <tr>
                <td><?= h($templatePowers->id) ?></td>
                <td><?= h($templatePowers->template_id) ?></td>
                <td><?= h($templatePowers->power_id) ?></td>
                <td><?= h($templatePowers->power_cost) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TemplatePowers', 'action' => 'view', $templatePowers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TemplatePowers', 'action' => 'edit', $templatePowers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TemplatePowers', 'action' => 'delete', $templatePowers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $templatePowers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
