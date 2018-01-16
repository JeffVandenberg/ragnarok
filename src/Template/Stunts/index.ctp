<?php

use App\Model\Entity\Stunt;
use App\View\AppView;

/* @var AppView $this */
/* @var Stunt[] $stunts */

$this->set('title_for_layout', 'Stunts')
?>

<div class="stunts index" id="page-content">
    <h2><?php echo __('Stunts'); ?></h2>
    <table id="content-table">
        <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('stunt_name'); ?></th>
            <th><?php echo $this->Paginator->sort('cost'); ?></th>
            <th><?php echo $this->Paginator->sort('Skills.skill_name', 'Skill'); ?></th>
            <th><?php echo $this->Paginator->sort('is_official', 'Official'); ?></th>
            <th><?php echo $this->Paginator->sort('is_approved', 'Approved'); ?></th>
            <th><?php echo $this->Paginator->sort('CreatedBy.username', 'Created By'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        </thead>
        <?php foreach ($stunts as $stunt): ?>
            <tr>
                <td><?php echo h($stunt->stunt_name); ?>&nbsp;</td>
                <td><?php echo h($stunt->cost); ?>&nbsp;</td>
                <td>
                    <?php echo $this->Html->link($stunt->skill->skill_name, array('controller' => 'skills', 'action' => 'view', $stunt->skill_id)); ?>
                </td>
                <td><?php echo ($stunt->is_official) ? __('Yes') : __('No'); ?>&nbsp;</td>
                <td><?php echo ($stunt->is_approved) ? __('Yes') : __('No'); ?>&nbsp;</td>
                <td>
                    <?php echo h($stunt->created_by->username); ?>
                </td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $stunt->id)); ?>
                    <?php if (isset($actions['edit'])): ?>
                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $stunt->id)); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $stunt->id), ['confirm' => __('Are you sure you want to delete ' . $stunt->stunt_name)]); ?>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
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
<?php if (isset($actions['add'])): ?>
    <?php $this->start('context-navigation'); ?>
    <div class="context-group">
        <h3><?php echo __('Actions'); ?></h3>
        <ul>
            <li><?php echo $this->Html->link(__('New Stunt'), array('action' => 'add')); ?></li>
        </ul>
    </div>
    <?php $this->end(); ?>
<?php endif; ?>

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
