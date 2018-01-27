<?php

use App\Model\Entity\Character;
use App\View\AppView;

/* @var Character $character */
/* @var array $options */
/* @var AppView $this */

$this->set('title_for_layout', $character->character_name);

$this->start('script');
echo $this->Html->script('df-character');
$this->end();
?>

<?php echo $this->Character->create($character, $options); ?>

<?php $this->start('javascript'); ?>
<script type="text/javascript">
    dfCharacter.editSkills = false;
    $(function () {
        $("#tabs").tabs();
    });
    tinymce.init({
        selector: "textarea.full-editor",
        theme: "modern",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor"
        ],
        toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        toolbar2: "print preview media | forecolor backcolor emoticons",
        image_advtab: true,
        height: 600
    });
</script>
<?php $this->end(); ?>
