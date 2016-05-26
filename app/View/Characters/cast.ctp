<?php /* @var View $this */ ?>
<?php /* @var Character[] $characters */ ?>
<?php $this->set('title_for_layout', 'Cast of Characters'); ?>
<?php $this->Paginator->options(array(
    'update' => '#page-content',
    'evalScripts' => true
)); ?>
<div class="characters index" id="page-content">
    <h2><?php echo __('Characters'); ?></h2>
    <table class="hover">
        <tr>
            <th><?php echo $this->Paginator->sort('character_name', 'Name'); ?></th>
            <th><?php echo $this->Paginator->sort('Template.template_name', 'Template'); ?></th>
            <th><?php echo $this->Paginator->sort('CreatedBy.username', 'Player'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($characters as $character): ?>
            <tr>
                <td><?php echo h($character['Character']['character_name']); ?>&nbsp;</td>
                <td>
                    <?php echo h($character['Template']['template_name']); ?>
                </td>
                <td>
                    <?php echo h($character['CreatedBy']['username']); ?>
                </td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'publicView', $character['Character']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="paging pagination">
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?>
        <ul class="pagination" role="navigation" aria-label="Pagination">
            <?php
            echo $this->Paginator->prev(
                __('Previous'),
                [
                    'class' => 'pagination-previous',
                    'tag' => 'li'
                ],
                null,
                [
                    'class' => 'prev disabled',
                    'tag' => 'li'
                ]
            );
            echo $this->Paginator->numbers([
                'before' => false,
                'after' => false,
                'tag' => 'li',
                'separator' => ''
            ]);
            echo $this->Paginator->next(
                __('Next'),
                [
                    'class' => 'pagination-next',
                    'tag' => 'li'
                ],
                null,
                [
                    'class' => 'next disabled',
                    'tag' => 'li'
                ]);
            ?>
        </ul>
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
