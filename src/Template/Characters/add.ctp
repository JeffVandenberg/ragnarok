<?php

use App\Model\Entity\Character;
use App\View\AppView;

/* @var AppView $this */
/* @var Character $character */
/* @var int $skillPoints */
/* @var $skillSpreads array */
/* @var $skills array */

$this->set('title_for_layout', 'Create Character');

$this->start('script');
echo $this->Html->script('df-character');
$this->end();

if(isset($skills)) {
    $options['skills'] = $skills;
}

echo $this->Form->create($character);
echo $this->Character->create($character, $options);
?>
<div>
    <?php echo $this->Form->submit('Save', [
        'id' => 'form-submit'
    ]); ?>
</div>
<?php echo $this->Form->end(); ?>
<div id="sheet-subview" style="display:none;"></div>

<?php $this->start('javascript'); ?>
<script type="text/javascript">
    dfCharacter.skillPoints = <?php echo $skillPoints; ?>;
    dfCharacter.powerLevel = <?php echo $character->power_level; ?>;
</script>
<script type="text/javascript">
</script>
<?php $this->end(); ?>
