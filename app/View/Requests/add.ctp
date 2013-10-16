<?php /* @var View $this */ ?>
<?php /* @var int $characterId */ ?>
<?php $this->set('title_for_layout', 'Create Request'); ?>
<?php $this->start('script'); ?>
<?php echo $this->Html->script('tinymce/tinymce.min'); ?>
<?php echo $this->Html->script('tinymce/jquery.tinymce.min'); ?>
<?php $this->end(); ?>
<div class="requests form">
    <?php echo $this->Form->create('RagRequest'); ?>
    <h2><?php echo __('Add Request'); ?></h2>
    <?php
    echo $this->Form->hidden('character_id', array('value' => $characterId));
    echo $this->Form->input('title', array('style' => 'width: 300px'));
    echo $this->Form->input('request_type_id');
    echo $this->Form->input('group_id');
    echo $this->Form->input('body', array('class' => 'simple-editor', 'required' => false));
    echo $this->Form->submit('Submit Request', array('name' => 'action'));
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