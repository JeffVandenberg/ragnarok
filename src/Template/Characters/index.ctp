<?php

use App\Model\Entity\Character;
use App\View\AppView;

/* @var AppView $this */
/* @var Character[] $characters */

$this->set('title_for_layout', 'Your Characters');
?>
<div class="characters index" id="page-content">
    <h2><?php echo __('Characters'); ?></h2>
    <table id="content-table">
        <tr>
            <th><?php echo $this->Paginator->sort('character_name', 'Name'); ?></th>
            <th><?php echo $this->Paginator->sort('CharacterStatuses.name', 'Status'); ?></th>
            <th><?php echo $this->Paginator->sort('updated_by_id'); ?></th>
            <th><?php echo $this->Paginator->sort('updated'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($characters as $character): ?>
            <tr>
                <td><?php echo h($character->character_name); ?>&nbsp;</td>
                <td>
                    <?php echo h($character->character_status->name); ?>
                </td>
                <td>
                    <?php echo h($character->updated_by->username); ?>
                </td>
                <td><?php echo $this->Time->format($character->updated); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $character->id)); ?>
                    <?php echo $this->Html->Link(__('Tools'), array('action' => 'tools', $character->id)); ?>
                    <?php echo $this->Html->link(__('Public'), array('action' => 'publicView', $character->id)); ?>
                    <?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $character->id), null, __('Are you sure you want to delete # %s?', $character->id)); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php $this->start('context-navigation'); ?>
<div class="context-group">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('New Character'), array('action' => 'add')); ?></li>
    </ul>
</div>
<?php $this->end(); ?>
<script>
    $(function () {
        $(document).on('click', '.pagination a, #content-table thead a', function () {
            var target = $(this).attr('href');

            $.get(target, function (data) {
                $('#page-content').html($(data).filter("#page-content"));
                var state = {html: 'doTo'};
                window.history.pushState(state, 'Cast', target);

            }, 'html');

            return false;
        });
    });
</script>
