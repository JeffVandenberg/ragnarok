<?php /* @var View $this */ ?>
<?php $this->set('title_for_layout', __('Add note to: ') . $this->request->data['RagRequest']['title']); ?>
<?php $this->start('script'); ?>
<?php echo $this->Html->script('tinymce/tinymce.min'); ?>
<?php echo $this->Html->script('tinymce/jquery.tinymce.min'); ?>
<?php $this->end(); ?>
<h2><?php echo __('Add note to: ') . $this->request->data['RagRequest']['title']; ?></h2>

<?php echo $this->Form->create(false); ?>
<?php echo $this->Form->textarea('request_note', array('class' => 'simple-editor')); ?>
<?php echo $this->Form->submit('Add Note', array('name' => 'action', 'class' => 'button')); ?>
<?php echo $this->Form->submit('Cancel', array('name' => 'action', 'class' => 'button')); ?>
<?php echo $this->Form->end(); ?>
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