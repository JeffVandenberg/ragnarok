<?php $this->set('title_for_layout', 'Add Power'); ?>
<div class="powers form">
<?php echo $this->Form->create('Power'); ?>
	<h3><?php echo __('Add Power'); ?></h3>
	<?php
		echo $this->Form->input('power_name');
    ?>
    For official powers, please only provide a page number reference or url.
    <?php
		echo $this->Form->input('description', array('style' => 'width: 100%', 'rows' => '10'));
		echo $this->Form->input('cost');
		echo $this->Form->input('is_official');
		echo $this->Form->input('is_approved');
        echo $this->Form->submit(__('Submit'), array('name' => 'action'));
        echo $this->Form->submit(__('Cancel'), array('name' => 'action', 'formnovalidate' => true));
	?>
<?php echo $this->Form->end(); ?>
</div>
<script type="text/javascript">
    $(function(){
    });
</script>