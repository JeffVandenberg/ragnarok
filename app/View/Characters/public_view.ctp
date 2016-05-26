<?php /* @var View $this */ ?>
<?php /* @var array $character */ ?>
<?php $this->set('title_for_layout', 'Public Information for ' . $character['Character']['character_name']); ?>
<h2><?php echo h($character['Character']['character_name']); ?></h2>
<div class="tinymce-content callout">
    <?php echo $character['Character']['public_information']; ?>
</div>
