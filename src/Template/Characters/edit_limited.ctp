<?php /* @var View $this */ ?>
<?php /* @var array $character */ ?>
<?php $this->set('title_for_layout', 'Update ' . $character['Character']['character_name']); ?>
<?php $this->start('script'); ?>
<?php echo $this->Html->script('tinymce/tinymce.min'); ?>
<?php echo $this->Html->script('tinymce/jquery.tinymce.min'); ?>
<?php $this->end(); ?>

<?php echo $this->Form->create('Character'); ?>
<?php echo $this->Form->input('id'); ?>
<?php echo $this->Form->input('current_fate'); ?>
    Public Character Page. Put anything and everything you want people to know about your character here.
<?php echo $this->Form->textarea('public_information', array('class' => 'full-editor')); ?>
<?php echo $this->Form->end('Save'); ?>
<?php $this->start('javascript'); ?>
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
