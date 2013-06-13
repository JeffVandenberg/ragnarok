<?php /* @var View $this */ ?>
<?php $this->set('title_for_layout', 'Home'); ?>

    <div class="paragraph">
        Welcome to Ragnarok NYC, an NYC based Chat Game.
    </div>
    <div class="paragraph">
        Stay tuned for more details.
    </div>
    <div class="paragraph">
        <?php echo $this->Html->link('Register', array('controller' => 'users', 'action' => 'register')); ?>
    </div>

<?php $this->start('right-nav') ?>
    <div id="right-nav">
        <div class="right-box">
            <div class="title">
                Chat Login
            </div>
            <?php echo $this->Form->create(false, array('action' => 'chat', 'method' => 'post')) ?>
            <?php echo $this->Form->input('name'); ?>
            <?php echo $this->Form->end('Login'); ?>
        </div>
        <div class="right-box">
            <div class="paragraph">
                There can be more text here.
            </div>
            <div class="paragraph">
                I bet it will be awesome!
            </div>
            <div class="paragraph">
                Or not
            </div>
        </div>
    </div>
<?php $this->end(); ?>