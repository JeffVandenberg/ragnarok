<?php /* @var View $this */ ?>
<?php /* @var array $actions */ ?>
<?php /* @var array $template */ ?>

<?php $this->set('title_for_layout', __('Stunt') . ': ' . h($template['Template']['template_name'])); ?>

    <div class="templates view">
        <h2><?php echo __('Template'); ?>: <?php echo h($template['Template']['template_name']); ?></h2>
        <dl>
            <dt><?php echo __('Description'); ?></dt>
            <dd>
                <?php echo h($template['Template']['description']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Is Official'); ?></dt>
            <dd>
                <?php echo ($template['Template']['is_official']) ? __('Yes') : __('No'); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Is Approved'); ?></dt>
            <dd>
                <?php echo ($template['Template']['is_approved']) ? __('Yes') : __('No'); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Created By'); ?></dt>
            <dd>
                <?php echo h($template['CreatedBy']['username']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Created'); ?></dt>
            <dd>
                <?php echo h($template['Template']['created']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Updated By'); ?></dt>
            <dd>
                <?php echo h($template['UpdatedBy']['username']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Updated'); ?></dt>
            <dd>
                <?php echo h($template['Template']['updated']); ?>
                &nbsp;
            </dd>
        </dl>
    </div>
<br />
<h3>Powers</h3>
<?php if(count($template['TemplatePower']) > 0): ?>
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
        <?php foreach($template['TemplatePower'] as $aTemplatePower): ?>
            <tr>
                <td>
                    <?php echo $this->Html->link(
                        h($aTemplatePower['Power']['power_name']),
                        array(
                            'controller' => 'powers',
                            'action' => 'view',
                            $aTemplatePower['power_id']));
                    ?>
                </td>
                <td>
                    <?php echo $aTemplatePower['power_cost']; ?>
                </td>
                <td>
                    <?php if ($aTemplatePower['power_cost'] != $aTemplatePower['Power']['cost']): ?>
                        Regular Cost: <?php echo $aTemplatePower['Power']['cost']; ?>
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
                <li><?php echo $this->Html->link(__('Edit Template'), array('action' => 'edit', $template['Template']['id'])); ?> </li>
                <li><?php echo $this->Form->postLink(__('Delete Template'), array('action' => 'delete', $template['Template']['id']), null, __('Are you sure you want to delete # %s?', $template['Template']['id'])); ?> </li>
            <?php endif; ?>
        </ul>
    </div>
<?php $this->end(); ?>