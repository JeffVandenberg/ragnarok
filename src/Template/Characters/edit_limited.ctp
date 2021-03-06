<?php
use App\Model\Entity\Character;
use App\View\AppView;

/* @var AppView $this */
/* @var Character $character */

$this->start('script');
echo $this->Html->script('df-character');
$this->end();

$this->set('title_for_layout', 'Update ' . $character->character_name);
?>

<?php echo $this->Form->create($character); ?>
<div class="characters form">
    <?php echo $this->Character->create($character, $options); ?>
</div>
<div>
    <?php echo $this->Form->submit('Save', [
        'id' => 'form-submit'
    ]); ?>
</div>
<?php echo $this->Form->end(); ?>
<div id="sheet-subview" style="display:none;"></div>
<script type="text/javascript">
    dfCharacter.editSkills = false;
</script>
