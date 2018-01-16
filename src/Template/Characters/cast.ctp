<?php

use App\Model\Entity\Character;
use App\View\AppView;

/* @var AppView $this */
/* @var Character[] $characters */

$this->set('title_for_layout', 'Cast of Characters');
?>
<div class="characters index" id="page-content">
    <h2><?php echo __('Characters'); ?></h2>
    <table class="hover" id="content-table">
        <tr>
            <th><?php echo $this->Paginator->sort('character_name', 'Name'); ?></th>
            <th><?php echo $this->Paginator->sort('Templates.template_name', 'Template'); ?></th>
            <th><?php echo $this->Paginator->sort('CreatedBy.username', 'Player'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($characters as $character): ?>
            <tr>
                <td><?php echo h($character->character_name); ?>&nbsp;</td>
                <td>
                    <?php echo h($character->template->template_name); ?>
                </td>
                <td>
                    <?php echo h($character->created_by->username); ?>
                </td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'publicView', $character->id)); ?>
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
