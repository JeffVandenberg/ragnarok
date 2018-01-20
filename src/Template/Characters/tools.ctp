<?php

use App\Model\Entity\Character;
use App\Model\Entity\CharacterStatus;
use App\View\AppView;

/* @var AppView $this */
/* @var Character $character */

$this->set('title_for_layout', $character->character_name); ?>

<h3><?php echo __('Tools for ') . $character->character_name; ?></h3>

<div class="paragraph">
    <?php echo $this->Html->link(__('View'), ['action' => 'view', $character->id]); ?>
</div>
<div class="paragraph">
    <?php if ($character->character_status_id == CharacterStatus::New): ?>
        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $character->id)); ?>
    <?php else: ?>
        <?php echo $this->Html->link(__('Edit'), array('action' => 'editLimited', $character->id)); ?>
    <?php endif; ?>
</div>
<div class="paragraph">
    <?php echo $this->Html->link(__('Dice'), array('controller' => 'DiceRolls', 'action' => 'character', $character->id)); ?>
</div>
<div class="paragraph">
    <?php echo $this->Html->link(__('Public'), array('action' => 'publicView', $character->id)); ?>
</div>
<div class="paragraph">
    <?php echo $this->Html->link(__('Chat Login'), '/chat/?character_id=' . $character->id, array('target' => '_blank')); ?>
</div>
