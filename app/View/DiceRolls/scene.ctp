<?php /* @var View $this */ ?>
<?php /* @var array $diceRolls */ ?>
<?php /* @var bool $isAjax */ ?>
<?php $this->Paginator->options(array(
    'update' => '#dice-rolls',
    'evalScripts' => true
)); ?>
<?php if(!$isAjax): ?>
    <?php $this->set('title_for_layout', 'Scene Interface'); ?>
    <h2>Scene Interface</h2>

    <?php echo $this->Form->create('DiceRoll'); ?>
    <table class="undecorated-table">
        <tr>
            <td>
                <?php echo $this->Form->input('action_note', array('style' => 'width:90%;')); ?>
            </td>
            <td>
                <?php echo $this->Form->input('skill_id'); ?>
            </td>
            <td>
                <?php echo $this->Form->input('skill_level', array('style' => 'width:60px;', 'value' => 0)); ?>
            </td>
            <td>
                <?php echo $this->Form->input('modifier', array('style' => 'width:60px', 'value' => 0)); ?>
            </td>
            <td>
                <?php echo $this->Form->input('fate_spent', array('style' => 'width:60px;', 'value' => 0)); ?>
            </td>
            <td rowspan="2">
                <?php echo $this->Form->input('aspects_tagged'); ?>
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
        <table>
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
                        <?php if(isset($diceRoll['Character']['character_name'])): ?>
                            <?php echo h($diceRoll['Character']['character_name']); ?>
                        <?php else: ?>
                            Scene Roll
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php echo h($diceRoll['DiceRoll']['action_note']); ?>
                    </td>
                    <td>
                        <?php echo h($diceRoll['Skill']['skill_name']); ?>
                    </td>
                    <td>
                        <?php echo h($diceRoll['DiceRoll']['skill_level']); ?>
                    </td>
                    <td>
                        <?php echo h($diceRoll['DiceRoll']['roll_total']); ?>
                    </td>
                    <td>
                        <?php echo h($diceRoll['DiceRoll']['modifier']); ?>
                    </td>
                    <td>
                        <?php echo $diceRoll['DiceRoll']['roll_total'] + $diceRoll['DiceRoll']['skill_level'] + $diceRoll['DiceRoll']['modifier']; ?>
                    </td>
                    <td>
                        <?php echo h($diceRoll['CreatedBy']['username']); ?>
                    </td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('action' => 'view', $diceRoll['DiceRoll']['id']), array('class' => 'roll-view')); ?>
                        <?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $character['Character']['id'])); ?>
                        <?php //echo $this->Html->link(__('Dice'), array('controller' => 'DiceRolls', 'action' => 'character', $character['Character']['id'])); ?>
                        <?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $character['Character']['id']), null, __('Are you sure you want to delete # %s?', $character['Character']['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="paging">
            <?php
            echo $this->Paginator->counter(array(
                'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
            ));
            ?>
            <p>
                <?php
                echo $this->Paginator->prev('< ' . __('Previous'), array(), null, array('class' => 'prev disabled'));
                echo $this->Paginator->numbers(array('separator' => ''));
                echo $this->Paginator->next(__('Next') . ' >', array(), null, array('class' => 'next disabled'));
                ?>
            </p>
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
            if(result == -1) {
                $("#dice-" + dice).attr('src', '<?php echo $this->Html->url('/') . 'img/fate_magicminus.png';?>');
            }
            if(result == 0) {
                $("#dice-" + dice).attr('src', '<?php echo $this->Html->url('/') . 'img/fate_magicblank.png';?>');
            }
            if(result == 1) {
                $("#dice-" + dice).attr('src', '<?php echo $this->Html->url('/') . 'img/fate_magicplus.png';?>');
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
                    '<?php echo $this->Html->url(array('action' => 'rollDiceScene')); ?>',
                    data,
                    function (response) {
                        roll.showRolls = false;
                        var i;
                        if(response.data.result == 'success') {
                            for (i = 0; i < response.data.rolls.length; i++) {
                                var result = response.data.rolls[i];
                                updateDiceImage(i, result);
                            }
                            $("#dice-rolls").load(
                                '<?php echo $this->Html->url(); ?>/page:1',
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