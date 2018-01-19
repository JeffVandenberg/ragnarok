<?php

use App\Model\Entity\Configuration;
use App\View\AppView;

/* @var AppView $this */
/* @var Configuration[] $configs */

$this->set('title_for_layout', 'Game Configuration');
?>
<h2><?php echo __('Configuration'); ?></h2>
<table>
    <thead>
    <tr>
        <th>
            Setting
        </th>
        <th>
            Value
        </th>
        <th>
            Key
        </th>
    </tr>
    </thead>
    <?php foreach($configs as $config): ?>
        <tr>
            <td>
                <?php echo $config->description; ?>
            </td>
            <td>
                <?php echo $config->value; ?>
            </td>
            <td>
                <?php echo $config->key; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php $this->start('context-navigation'); ?>
    <div class="context-group">
        <h3><?php echo __('Actions'); ?></h3>
        <ul>
            <li><?php echo $this->Html->link(__('Edit Configuration'), array('action' => 'edit')); ?></li>
        </ul>
    </div>
<?php $this->end(); ?>
