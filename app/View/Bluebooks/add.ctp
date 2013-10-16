<?php /* @var View $this */ ?>
<?php $this->set('title_for_layout', 'Add Bluebook Entry'); ?>
<?php $this->start('script'); ?>
<?php echo $this->Html->script('tinymce/tinymce.min'); ?>
<?php echo $this->Html->script('tinymce/jquery.tinymce.min'); ?>
<?php $this->end(); ?>

<div class="bluebooks form">
    <?php echo $this->Form->create('Bluebook'); ?>
    <h2><?php echo __('Add Bluebook Entry'); ?></h2>
    <?php
    echo $this->Form->input('title', array('style' => 'width: 300px;'));
    echo $this->Form->input('body', array('class' => 'simple-editor', 'required' => false));
    echo $this->Form->submit('Submit Entry', array('name' => 'action'));
    echo $this->Form->submit('Cancel', array('name' => 'action'));
    ?>
    <?php echo $this->Form->end(); ?>
</div>
<?php $this->start('javascript'); ?>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea.simple-editor",
            theme: "modern",
            plugins: [
                "wordcount fullscreen",
                "table contextmenu paste textcolor"
            ],
            toolbar: "undo redo | bold italic | forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
            image_advtab: true,
            height: 200
        });
    </script>
<?php $this->end(); ?>