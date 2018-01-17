<?php

use App\View\AppView;

/* @var AppView $this */
$this->set('title_for_layout', 'A Dresden Files Online Game');
$this->set('breadcrumbs', [
    'Home' => ['current' => true, 'url' => '/'],
]);
?>

<div class="tinymce-content">
    <?php echo $frontPage; ?>
</div>


<?php $this->start('context-navigation') ?>
<div class="context-group">
    <div class="right-box">
        <?php echo $this->Login->GetUserBox(); ?>
    </div>
</div>
<div class="context-group">
    <h3>Chat Login</h3>
    <?php if ($this->request->getSession()->read('Auth.User.user_id') != 1): ?>
        <div class="paragraph">
            <?php echo $this->Html->link('Login OOC', '/chat/'); ?>
        </div>
    <?php else: ?>
        <form method="post" action="/chat/">
            <?php echo $this->Form->control('username', ['value' => '', 'id' => 'chat-username']); ?>
            <?php echo $this->Form->button('Login', array('type' => 'submit')); ?>
        </form>
    <?php endif; ?>
</div>
<div class="context-group">
    <h3>Quick Tools</h3>
    <?php if ($this->request->getSession()->read('Auth.User.user_id') != 1): ?>
        <div class="paragraph">
            <?php echo $this->Html->link('Create Character', array('controller' => 'characters', 'action' => 'add')); ?>
        </div>
    <?php endif; ?>
    <div class="paragraph">
        <?php echo $this->Html->link('Dice Roller', array('controller' => 'dice', 'action' => 'index')); ?>
    </div>
</div>
<?php $this->end(); ?>
