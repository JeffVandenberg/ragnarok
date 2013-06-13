<?php /* @var View $this */ ?>
<?php $this->set('title_for_layout', 'Chatting as ' . $name); ?>
Chatting as <?php echo $name; ?><br />
<?php echo $this->AddOnChat->makeChat($name); ?>
