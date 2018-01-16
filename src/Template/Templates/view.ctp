<?php

use App\Model\Entity\Template;
use App\View\AppView;

/* @var AppView $this */
/* @var array $actions */
/* @var Template $template */

$this->set('title_for_layout', __('Template') . ': ' . h($template->template_name));
?>

    <div class="templates view">
        <h2><?php echo __('Template'); ?>: <?php echo h($template->template_name); ?></h2>
        <dl>
            <dt><?php echo __('Description'); ?></dt>
            <dd>
                <?php echo $this->Text->autoParagraph(h($template->description)); ?>
            </dd>
            <dt><?php echo __('Is Official'); ?></dt>
            <dd>
                <?php echo ($template->is_official) ? __('Yes') : __('No'); ?>
            </dd>
            <dt><?php echo __('Is Approved'); ?></dt>
            <dd>
                <?php echo ($template->is_approved) ? __('Yes') : __('No'); ?>
            </dd>
            <dt><?php echo __('Created By'); ?></dt>
            <dd>
                <?php echo h($template->created_by->username); ?>
            </dd>
            <dt><?php echo __('Created'); ?></dt>
            <dd>
                <?php echo h($template->created); ?>
            </dd>
            <dt><?php echo __('Updated By'); ?></dt>
            <dd>
                <?php echo h($template->updated_by->username); ?>
            </dd>
            <dt><?php echo __('Updated'); ?></dt>
            <dd>
                <?php echo h($template->updated); ?>
            </dd>
        </dl>
    </div>
    <br/>
    <h3>Powers</h3>
<?php if (count($template->template_powers)): ?>
    <table>
        <tr>
            <th>
                Power
            </th>
            <th>
                Cost
            </th>
            <th>
                Notes
            </th>
        </tr>
        <?php foreach ($template->template_powers as $templatePower): ?>
            <tr>
                <td>
                    <?php echo $this->Html->link(
                        h($templatePower->power->power_name),
                        array(
                            'controller' => 'powers',
                            'action' => 'view',
                            $templatePower->power_id));
                    ?>
                </td>
                <td>
                    <?php echo $templatePower->power_cost; ?>
                </td>
                <td>
                    <?php if ($templatePower->power_cost != $templatePower->power->cost): ?>
                        Regular Cost: <?php echo $templatePower->power->cost; ?>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    No Powers associated with the template.
<?php endif; ?>
<?php $this->start('context-navigation'); ?>
    <div class="context-group">
        <h3><?php echo __('Actions'); ?></h3>
        <ul>
            <li><?php echo $this->Html->link(__('List Templates'), array('action' => 'index')); ?> </li>
            <?php if (isset($actions['add'])): ?>
                <li><?php echo $this->Html->link(__('Add Template'), array('action' => 'add')); ?> </li>
            <?php endif; ?>
            <?php if (isset($actions['edit'])): ?>
                <li><?php echo $this->Html->link(__('Edit Template'), array('action' => 'edit', $template->id)); ?> </li>
                <li><?php echo $this->Form->postLink(__('Delete Template'), array('action' => 'delete', $template->id), ['confirm' =>  __('Are you sure you want to delete ' . $template->template_name)]); ?> </li>
            <?php endif; ?>
        </ul>
    </div>
<?php $this->end(); ?>
