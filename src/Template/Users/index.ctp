<?php

use App\Model\Entity\User;
use App\View\AppView;

/* @var AppView $this */
/* @var User[] $users */

$this->set('title_for_layout', 'Users');
?>

<div class="users index" id="page-content">
    <h2><?php echo __('Users'); ?></h2>
    <div>
        <?php echo $this->Form->control('search', ['id' => 'search-box', 'value' => $filter]); ?>
    </div>
    <table id="content-table">
        <tr>
            <th><?php echo $this->Paginator->sort('username_clean', 'Username'); ?></th>
            <th><?php echo $this->Paginator->sort('user_email'); ?></th>
            <th><?php echo $this->Paginator->sort('user_lastvisit', 'Last Visit'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo h($user->username); ?>&nbsp;</td>
                <td><?php echo h($user->user_email); ?>&nbsp;</td>
                <td><?php echo ($user->user_lastvisit) ? $this->Time->format($user['User']['user_lastvisit']) : ''; ?>
                    &nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $user->user_id)); ?>
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

<script>
    $(function () {
        function updateSearch() {
            var url = '/users?filter='+$("#search-box").val();
            $("#page-content").load(url);
            window.history.pushState({html: 'toDo'}, 'Users', url)
        }
        $("#search-box").keydown($.debounce(250, updateSearch));

        $(document).on('click', '.pagination a, #content-table thead a', function () {
            var target = $(this).attr('href');

            $.get(target, function (data) {
                $('#page-content').html($(data).filter("#page-content"));
                var state = {html: 'doTo'};
                window.history.pushState(state, 'Users', target);

            }, 'html');

            return false;
        });
    });
</script>
