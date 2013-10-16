<?php /* @var View $this */ ?>
<?php /* @var array $character */ ?>
<?php $this->set('title_for_layout', $character['Character']['character_name']); ?>

<h3><?php echo __('Tools for ') . $character['Character']['character_name']; ?></h3>

<div class="paragraph">
    <?php echo $this->Html->link(__('View'), array('action' => 'view', $character['Character']['id'])); ?>
</div>
<div class="paragraph">
    <?php App::uses('CharacterStatus', 'Model'); ?>
    <?php if ($character['Character']['character_status_id'] == CharacterStatus::NewCharacter): ?>
        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $character['Character']['id'])); ?>
    <?php else: ?>
        <?php echo $this->Html->link(__('Edit'), array('action' => 'editLimited', $character['Character']['id'])); ?>
    <?php endif; ?>
</div>
<div class="paragraph">
    <?php echo $this->Html->link(__('Dice'), array('controller' => 'DiceRolls', 'action' => 'character', $character['Character']['id'])); ?>
</div>
<div class="paragraph">
    <?php echo $this->Html->link(__('Requests'), array('controller' => 'Requests', 'action' => 'character', $character['Character']['id'])); ?>
</div>
<div class="paragraph">
    <?php echo $this->Html->link(__('Bluebooks'), array('controller' => 'Bluebooks', 'action' => 'character', $character['Character']['id'])); ?>
</div>
<div class="paragraph">
    <?php echo $this->Html->link(__('Public'), array('action' => 'publicView', $character['Character']['id'])); ?>
</div>
<div class="paragraph">
    <?php echo $this->Html->link(__('Chat Login'), '/chat/?character_id=' . $character['Character']['id'], array('target' => '_blank')); ?>
</div>
