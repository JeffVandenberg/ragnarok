<?php

use App\Model\Entity\Character;
use App\View\AppView;

/* @var AppView $this */
/* @var Character $character */
/* @var array $skillSpreads */
/* @var array $templates */
/* @var array $skills */
/* @var array $characterStatuses */

$this->set('title_for_layout', 'GM Character View');

?>

<form method="post">
    <div class="input">
        <?php echo $this->Form->hidden('lookup_id', [
            'id' => 'lookup-id'
        ]); ?>
        <?php echo $this->Form->control('lookup_name', [
            'templates' => [
                'inputContainer' => '{{content}}'
            ]
        ]); ?>
        <?php echo $this->Form->submit('Search'); ?>
    </div>
</form>
<?php if (isset($character)): ?>
    <?php $this->start('script'); ?>
        <?php echo $this->Html->script('df-character'); ?>
    <?php $this->end(); ?>

    <?php echo $this->Form->create($character); ?>
    <?php echo $this->Character->create($character, $options); ?>
    <?php echo $this->Form->submit('Save', [
        'id' => 'form-submit'
    ]); ?>
    <?php echo $this->Form->end(); ?>
    <div id="sheet-subview" style="display:none;"></div>

    <?php $this->start('javascript'); ?>
    <script type="text/javascript">
        $(function () {
            $("#tabs").tabs();
        });
    </script>
    <script type="text/javascript">
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
<?php endif; ?>
<script>
    $(function () {
        $("#lookup-name")
            .autocomplete({
                source: baseUrl + 'characters/getList.json',
                minLength: 2,
                autoFocus: true,
                select: function (e, ui) {
                    $("#lookup-id").val(ui.item.value);
                    $("#lookup-name").val(ui.item.label);
                    $(this).closest('form').submit();
                    return false;
                },
                focus: function () {
                    return false;
                }
            });
    });
</script>
