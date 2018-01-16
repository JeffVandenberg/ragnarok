<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Power[]|\Cake\Collection\CollectionInterface $powers
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Power'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Character Powers'), ['controller' => 'CharacterPowers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Character Power'), ['controller' => 'CharacterPowers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Template Powers'), ['controller' => 'TemplatePowers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Template Power'), ['controller' => 'TemplatePowers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="powers index large-9 medium-8 columns content">
    <h3><?= __('Powers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('power_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cost') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_official') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_approved') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_by_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($powers as $power): ?>
            <tr>
                <td><?= $this->Number->format($power->id) ?></td>
                <td><?= h($power->power_name) ?></td>
                <td><?= $this->Number->format($power->cost) ?></td>
                <td><?= h($power->is_official) ?></td>
                <td><?= h($power->is_approved) ?></td>
                <td><?= $this->Number->format($power->created_by_id) ?></td>
                <td><?= h($power->created) ?></td>
                <td><?= $this->Number->format($power->updated_by_id) ?></td>
                <td><?= h($power->updated) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $power->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $power->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $power->id], ['confirm' => __('Are you sure you want to delete # {0}?', $power->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
