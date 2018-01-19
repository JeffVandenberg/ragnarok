<?php

use App\Model\Entity\DiceRoll;
use App\View\AppView;

/* @var AppView $this */
/* @var DiceRoll[] $diceRolls */
/* @var bool $isAjax */

?>
<?php if(!$isAjax): ?>
    <?php $this->set('title_for_layout', 'Scene Interface'); ?>
    <h2>Scene Interface</h2>

    <?php echo $this->Form->create('DiceRoll'); ?>
    <table class="undecorated-table">
        <tr>
            <td>
                <?php echo $this->Form->control('action_note', array('style' => 'width:90%;')); ?>
            </td>
            <td>
                <?php echo $this->Form->control('skill_id'); ?>
            </td>
            <td>
                <?php echo $this->Form->control('skill_level', array('style' => 'width:60px;', 'value' => 0)); ?>
            </td>
            <td>
                <?php echo $this->Form->control('modifier', array('style' => 'width:60px', 'value' => 0)); ?>
            </td>
            <td>
                <?php echo $this->Form->control('fate_spent', array('style' => 'width:60px;', 'value' => 0)); ?>
            </td>
            <td rowspan="2">
                <?php echo $this->Form->control('aspects_tagged'); ?>
            </td>
        </tr>
        <tr>
            <td colspan="5" style="text-align: center;background-color: transparent;">
                <?php echo $this->Form->submit('Roll Dice'); ?>
            </td>
        </tr>
    </table>
    <div class="paragraph" style="text-align: center;">
        <div id="roll-output">
            <?php echo $this->Html->image('fate_magicminus.png', array('id' => 'dice-0')); ?>
            <?php echo $this->Html->image('fate_magicblank.png', array('id' => 'dice-1')); ?>
            <?php echo $this->Html->image('fate_magicplus.png', array('id' => 'dice-2')); ?>
            <?php echo $this->Html->image('fate_magicblank.png', array('id' => 'dice-3')); ?>
        </div>
    </div>
<?php endif; ?>

    <div class="dice-rolls index" id="dice-rolls">
        <h2><?php echo __('Past Rolls'); ?></h2>
        <table id="content-table">
            <tr>
                <th>Character</th>
                <th>Note</th>
                <th>Skill</th>
                <th>Level</th>
                <th>Roll</th>
                <th>Modifier</th>
                <th>Total</th>
                <th>User</th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
            <?php foreach ($diceRolls as $diceRoll): ?>
                <tr>
                    <td>
                        <?php if(isset($diceRoll->character)): ?>
                            <?php echo h($diceRoll->character->character_name); ?>
                        <?php else: ?>
                            Scene Roll
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php echo h($diceRoll->action_note); ?>
                    </td>
                    <td>
                        <?php echo h($diceRoll->skill->skill_name); ?>
                    </td>
                    <td>
                        <?php echo h($diceRoll->skill_level); ?>
                    </td>
                    <td>
                        <?php echo h($diceRoll->roll_total); ?>
                    </td>
                    <td>
                        <?php echo h($diceRoll->modifier); ?>
                    </td>
                    <td>
                        <?php echo $diceRoll->roll_total + $diceRoll->skill_level + $diceRoll->modifier; ?>
                    </td>
                    <td>
                        <?php echo h($diceRoll->created_by->username); ?>
                    </td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), ['action' => 'view', $diceRoll->id], ['class' => 'roll-view']); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </div>
    </div>
    <div id="roll-detail" style="display:none;"></div>

<?php echo $this->Form->end(); ?>
<?php $this->start('script'); ?>
    <script>
        roll = {};
        roll.timeout = 35;
        roll.showRolls = false;

        function getRoll() {
            return Math.ceil(Math.random() * 3) - 2;
        }

        function updateDiceImage(dice, result) {
            if(result === -1) {
                $("#dice-" + dice).attr('src', '<?php echo $this->Html->Url->build('/') . 'img/fate_magicminus.png';?>');
            }
            if(result === 0) {
                $("#dice-" + dice).attr('src', '<?php echo $this->Html->Url->build('/') . 'img/fate_magicblank.png';?>');
            }
            if(result === 1) {
                $("#dice-" + dice).attr('src', '<?php echo $this->Html->Url->build('/') . 'img/fate_magicplus.png';?>');
            }
        }
        function updateRolls() {
            if(roll.showRolls) {
                updateDiceImage(roll.currentDie++, getRoll());
                if(roll.currentDie > 4) {
                    roll.currentDie = 0;
                }
                setTimeout(updateRolls, roll.timeout);
            }
        }

        $(function () {
            $(document)
                .on('click', '.roll-view', function(e) {
                    $('#roll-detail')
                        .load(
                        $(this).attr('href'),
                        null,
                        function() {
                            $(this).dialog({
                                modal: true,
                                width: 500,
                                height: 400,
                                title: 'View Roll   '
                            });
                        }
                    );
                    e.preventDefault();
                });
            $("form").submit(function (e) {
                updateDiceImage(0, 0);
                updateDiceImage(1, 0);
                updateDiceImage(2, 0);
                updateDiceImage(3, 0);
                roll.showRolls = true;
                setTimeout(updateRolls, roll.timeout);

                var form = $(this);
                var data = form.serializeArray();

                form.find('input').attr('disabled', 'disabled');
                $.post(
                    '/dice-rolls/roll-dice-scene/.json',
                    data,
                    function (response) {
                        roll.showRolls = false;
                        var i;
                        if(response.data.result === 'success') {
                            for (i = 0; i < response.data.rolls.length; i++) {
                                var result = response.data.rolls[i];
                                updateDiceImage(i, result);
                            }
                            $("#dice-rolls").load(
                                '<?php echo $this->Html->Url->build(); ?>/page:1',
                                null,
                                function() {
                                    form.find('input').attr('disabled', false);
                                }
                            );
                            $("#DiceRollActionNote").val('');
                            form.find('input').attr('disabled', false);
                        }
                        else {
                            for (i = 0; i < 4; i++) {
                                updateDiceImage(i, 0);
                            }
                            alert(response.data.message);
                            form.find('input').attr('disabled', false);
                        }
                    }
                );
                e.preventDefault();
            });
        })
    </script>
<?php $this->end(); ?>
