<?php
use App\Model\Entity\Stunt;
use App\View\AppView;

/* @var AppView $this */
/* @var Stunt $stunt */

$this->set('title_for_layout', __('Edit') . ': ' . $stunt->stunt_name);
?>

<div class="stunts form">
<?php echo $this->Form->create($stunt); ?>
    <h3><?php echo __('Edit Stunt'); ?></h3>
	<?php
		echo $this->Form->control('id');
		echo $this->Form->control('stunt_name');
		echo $this->Form->control('cost');
		echo $this->Form->control('skill_id');
		echo $this->Form->control('stunt_rules', array('style' => 'width: 100%', 'rows' => '10'));
		echo $this->Form->control('is_official');
		echo $this->Form->control('is_approved');
        echo $this->Form->submit(__('Submit'), array('name' => 'action'));
        echo $this->Form->submit(__('Cancel'), array('name' => 'action', 'formnovalidate' => true));
    ?>
    <?php echo $this->Form->end(); ?>
</div>
