<?php /* @var View $this */ ?>
<?php $this->set('title_for_layout', 'Edit Game Configuration'); ?>
    <h2><?php echo __('Edit Configuration'); ?></h2>
<?php echo $this->Form->create('Configuration'); ?>
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
        <?php foreach($configs as $i => $config): ?>
            <tr>
                <td style="vertical-align: middle;">
                    <?php echo $this->Form->hidden($i .'.Configuration.key', array('value' => $config['Configuration']['key'])); ?>
                    <?php echo $config['Configuration']['description']; ?>
                </td>
                <td>
                    <?php echo $this->Form->input(
                                          $i .'.Configuration.value',
                                          array(
                                              'value' => $config['Configuration']['value'],
                                              'label' => false
                                          )
                    ); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php echo $this->Form->end('Update'); ?>