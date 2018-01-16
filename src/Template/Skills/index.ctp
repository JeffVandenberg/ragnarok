<?php

use App\Model\Entity\Skill;
use App\View\AppView;

/* @var AppView $this */
/* @var Skill[] $skills */

$this->set('title_for_layout', 'Skills');
?>

<div class="skills index" id="page-content">
    <h2><?php echo __('Skills'); ?></h2>
    <table id="content-table">
        <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('skill_name'); ?></th>
            <th><?php echo $this->Paginator->sort('is_official', 'Official'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        </thead>
        <?php foreach ($skills as $skill): ?>
            <tr>
                <td><?php echo h($skill->skill_name); ?>&nbsp;</td>
                <td><?php echo ($skill->is_official) ? __('Yes') : __('No'); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $skill->id)); ?>
                    <?php if (isset($actions['edit'])): ?>
                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $skill->id)); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $skill->id), ['confirm' => __('Are you sure you want to delete ' . $skill->skill_name)]); ?>
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
            <li><?php echo $this->Html->link(__('New Skill'), array('action' => 'add')); ?></li>
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
