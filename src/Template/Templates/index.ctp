<?php

use App\Model\Entity\Template;
use App\View\AppView;

/* @var AppView $this */
/* @var Template[] $templates */

$this->set('title_for_layout', 'Templates');
?>
<div class="templates index" id="page-content">
    <h2><?php echo __('Templates'); ?></h2>
    <table id="table-content">
        <tr>
            <th><?php echo $this->Paginator->sort('template_name', 'Name'); ?></th>
            <th><?php echo $this->Paginator->sort('is_official', 'Official'); ?></th>
            <th><?php echo $this->Paginator->sort('is_approved', 'Approved'); ?></th>
            <th><?php echo $this->Paginator->sort('CreatedBy.username', 'Created By'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($templates as $template): ?>
            <tr>
                <td><?php echo h($template->template_name); ?>&nbsp;</td>
                <td><?php echo ($template->is_official) ? __('Yes') : __('No'); ?>&nbsp;</td>
                <td><?php echo ($template->is_approved) ? __('Yes') : __('No'); ?>&nbsp;</td>
                <td>
                    <?php echo h($template->created_by->username); ?>
                </td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $template->id)); ?>
                    <?php if (isset($actions['edit'])): ?>
                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $template->id)); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $template->id), ['confirm' => __('Are you sure you want to delete ' . $template->template_name)]); ?>
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
            <li><?php echo $this->Html->link(__('New Template'), array('action' => 'add')); ?></li>
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
