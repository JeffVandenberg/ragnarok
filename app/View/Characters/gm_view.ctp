<?php /* @var View $this */ ?>
<?php /* @var array $character */ ?>
<?php /* @var array $skillSpreads */ ?>
<?php /* @var array $templates */ ?>
<?php /* @var array $skills */ ?>
<?php /* @var array $characterStatuses */ ?>
<?php $this->set('title_for_layout', 'GM Character View'); ?>

    <form method="post">
        <div class="input">
            <?php echo $this->Form->hidden('lookup_id'); ?>
            <?php echo $this->Form->input('lookup_name', array('div' => false)); ?>
            <?php echo $this->Form->submit('Search'); ?>
        </div>
    </form>
<?php if (isset($this->request->data['Character'])): ?>
    <?php $this->start('script'); ?>
    <?php echo $this->Html->script('df-character'); ?>
    <?php echo $this->Html->script('tinymce/tinymce.min'); ?>
    <?php echo $this->Html->script('tinymce/jquery.tinymce.min'); ?>
    <?php $this->end(); ?>
    <?php
        $lists = array(
            'skillSpreads' => $skillSpreads,
            'templates' => $templates,
            'skills' => $skills,
            'characterStatuses' => $characterStatuses
        );
        $options = array(
            'all' => true,
            'gm_edit' => true,
            'current_fate' => true,
            'character_status' => true
        );
    ?>
    <?php echo $this->Form->create('Character'); ?>
    <?php echo $this->Character->MakeCharacterEdit($lists, $options); ?>
    <?php echo $this->Form->end('Save'); ?>
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
    $(function() {
        $("#lookup_name")
            .autocomplete({
                source: baseUrl + 'characters/getList.json',
                minLength: 2,
                select: function (e, ui) {
                    $("#lookup_id").val(ui.item.value);
                    $("#lookup_name").val(ui.item.label);
                    return false;
                },
                focus: function() {
                    return false;
                }
            });
    });
</script>