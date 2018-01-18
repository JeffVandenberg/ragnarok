<?php /* @var array $diceRoll */ ?>
<div class="dicerolls view">
<h2><?php  echo __('Dice Roll'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($diceRoll['DiceRoll']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Character'); ?></dt>
		<dd>
			<?php echo $this->Html->link($diceRoll['Character']['character_name'], array('controller' => 'characters', 'action' => 'view', $diceRoll['Character']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Roll Total'); ?></dt>
		<dd>
			<?php echo h($diceRoll['DiceRoll']['roll_total']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifier'); ?></dt>
		<dd>
			<?php echo h($diceRoll['DiceRoll']['modifier']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Skill'); ?></dt>
		<dd>
			<?php echo $this->Html->link($diceRoll['Skill']['skill_name'], array('controller' => 'skills', 'action' => 'view', $diceRoll['Skill']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Skill Level'); ?></dt>
		<dd>
			<?php echo h($diceRoll['DiceRoll']['skill_level']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fate Spent'); ?></dt>
		<dd>
			<?php echo h($diceRoll['DiceRoll']['fate_spent']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Aspects Tagged'); ?></dt>
		<dd>
			<?php echo str_replace("\n", "<br />", h($diceRoll['DiceRoll']['aspects_tagged'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo $this->Html->link($diceRoll['CreatedBy']['username'], array('controller' => 'users', 'action' => 'view', $diceRoll['CreatedBy']['user_id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($diceRoll['DiceRoll']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
