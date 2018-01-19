<?php

use App\Model\Entity\Configuration;
use App\View\AppView;

/* @var AppView $this */
/* @var Configuration[] $configs */

$this->set('title_for_layout', 'Edit Game Configuration');
?>

<h2><?php echo __('Edit Configuration'); ?></h2>
<?php echo $this->Form->create(new Configuration()); ?>
<table>
    <thead>
    <tr>
        <th>
            Setting
        </th>
        <th>
            Value
        </th>
    </tr>
    </thead>
    <?php foreach ($configs as $i => $config): ?>
        <tr>
            <td style="vertical-align: middle;">
                <?php echo $this->Form->hidden($i . '.key', ['value' => $config->key]); ?>
                <?php echo $config->description; ?>
            </td>
            <td>
                <?php if ($config->data_type == 'number'): ?>
                    <?php echo $this->Form->text(
                        $i . '.value',
                        array(
                            'value' => $config->value,
                            'label' => false,
                            'style' => 'width:30px;'
                        )
                    ); ?>
                <?php elseif ($config->data_type == 'text'): ?>
                    <?php echo $this->Form->textarea(
                        $i . '.value',
                        array(
                            'value' => $config->value,
                            'label' => false,
                            'class' => 'tinymce full-editor'
                        )
                    ); ?>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php echo $this->Form->submit('Update'); ?>
<?php echo $this->Form->end(); ?>
