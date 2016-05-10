<?php /* @var View $this */ ?>
<?php
$this->set('title_for_layout', 'Welcome');
$this->set('breadcrumbs', [
    'Home' => ['current' => true, 'url' => '/'],
]);
//$this->set('breadcrumbs', [
//    'Home' => ['current' => true, 'url' => '#'],
//    'News' => ['url' => '/home/news']
//]);

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
        <!--<form method="post" action="http://www.gamingsandbox.com/chatblazer">-->
        <?php if(AuthComponent::user('user_id') !== null): ?>
            <div class="paragraph">
                <?php echo $this->Html->link('Login OOC', '/chat/'); ?>
            </div>
        <?php else: ?>
        <form method="post" action="/chat/">
            <?php echo $this->Form->input('username', array('value' => AuthComponent::user('username'))); ?>
            <?php echo $this->Form->button('Login', array('type' => 'submit')); ?>
        </form>
        <?php endif; ?>
    </div>
    <div class="context-group">
        <h3>Quick Tools</h3>
        <div class="paragraph">
            <?php echo $this->Html->link('Create Character', array('controller' => 'characters', 'action' => 'add')); ?>
        </div>
        <div class="paragraph">
            <?php echo $this->Html->link('Dice Roller', array('controller' => 'dice', 'action' => 'index')); ?>
        </div>
    </div>
<?php $this->end(); ?>
