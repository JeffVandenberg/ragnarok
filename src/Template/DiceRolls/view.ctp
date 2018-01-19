<?php

use App\Model\Entity\DiceRoll;
use App\View\AppView;

/**
 * @var AppView $this
 * @var DiceRoll $diceRoll
 */

?>
<div class="dicerolls view">
    <h2><?php echo __('Dice Roll'); ?></h2>
    <dl>
        <dt><?php echo __('Id'); ?></dt>
        <dd>
            <?php echo h($diceRoll->id); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Character'); ?></dt>
        <dd>
            <?php echo $this->Html->link(
                $diceRoll->character->character_name,
                [
                    'controller' => 'characters', 'action' => 'view', $diceRoll->character_id
                ],
                [
                    'target' => '_blank'
                ]
            ); ?>
        </dd>
        <dt><?php echo __('Roll Total'); ?></dt>
        <dd>
            <?php echo h($diceRoll->roll_total); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Modifier'); ?></dt>
        <dd>
            <?php echo h($diceRoll->modifier); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Skill'); ?></dt>
        <dd>
            <?php echo $this->Html->link(
                $diceRoll->skill->skill_name,
                [
                    'controller' => 'skills', 'action' => 'view', $diceRoll->skill_id
                ],
                [
                    'target' => '_blank'
                ]
            ); ?>
        </dd>
        <dt><?php echo __('Skill Level'); ?></dt>
        <dd>
            <?php echo h($diceRoll->skill_level); ?>
        </dd>
        <dt><?php echo __('Fate Spent'); ?></dt>
        <dd>
            <?php echo h($diceRoll->fate_spent); ?>
        </dd>
        <dt><?php echo __('Aspects Tagged'); ?></dt>
        <dd>
            <?php echo $this->Text->autoparagraph(h($diceRoll->aspects_tagged)); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Created By'); ?></dt>
        <dd>
            <?php echo $diceRoll->created_by->username; ?>
        </dd>
        <dt><?php echo __('Created'); ?></dt>
        <dd>
            <?php echo $this->Time->format($diceRoll->created); ?>
        </dd>
    </dl>
</div>
