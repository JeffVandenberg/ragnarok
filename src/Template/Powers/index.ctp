<?php

use App\Model\Entity\Power;
use App\View\AppView;

/* @var AppView $this 
 * @var Power[] $powers
 * @var array $actions
 */

$this->set('title_for_layout', 'Stunts');
?>

<div class="powers index" id="page-content">
    <h2><?php echo __('Powers'); ?></h2>
    <table id="content-table">
        <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('power_name'); ?></th>
            <th><?php echo $this->Paginator->sort('cost'); ?></th>
            <th><?php echo $this->Paginator->sort('is_official', 'Official'); ?></th>
            <th><?php echo $this->Paginator->sort('is_approved', 'Approved'); ?></th>
            <th><?php echo $this->Paginator->sort('created_by_id'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        </thead>
        <?php foreach ($powers as $power): ?>
            <tr>
                <td><?php echo h($power->power_name); ?>&nbsp;</td>
                <td><?php echo h($power->cost); ?>&nbsp;</td>
                <td><?php echo ($power->is_official) ? 'Yes' : 'No'; ?>&nbsp;</td>
                <td><?php echo ($power->is_approved) ? 'Yes' : 'No'; ?>&nbsp;</td>
                <td>
                    <?php echo h($power->created_by->username); ?>
                </td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $power->id)); ?>
                    <?php if(isset($actions['edit'])): ?>
                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $power->id)); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $power->id), ['confirm' => __('Are you sure you want to delete ' .  $power->power_name . '?')]); ?>
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

<?php if(isset($actions['add'])): ?>
    <?php $this->start('context-navigation'); ?>
    <div class="context-group">
        <h3><?php echo __('Actions'); ?></h3>
        <ul>
            <li><?php echo $this->Html->link(__('New Power'), array('action' => 'add')); ?></li>
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
