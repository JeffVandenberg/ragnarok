<?php /* @var View $this */ ?>
<?php $this->set('title_for_layout', 'Dice Roller'); ?>

<div class="paragraph">
    <label>Rolls</label><br />
    <div id="roll-output">
        <?php echo $this->Html->image('fate_magicblank.png', array('id' => 'dice-0')); ?>
        <?php echo $this->Html->image('fate_magicblank.png', array('id' => 'dice-1')); ?>
        <?php echo $this->Html->image('fate_magicblank.png', array('id' => 'dice-2')); ?>
        <?php echo $this->Html->image('fate_magicblank.png', array('id' => 'dice-3')); ?>
    </div>
</div>

<div class="paragraph">
    <label>Total</label>: <span id="roll-total"></span><br />
</div>

<div class="paragraph">
    <input type="button" class="button" value="roll" id="roll-dice" />
</div>

<script type="text/javascript">
    function getRoll() {
        return Math.ceil(Math.random() * 3) - 2;
    }

    roll = {};
    roll.timeout = 35;
    roll.maxrolls = 0;


    function updateRolls() {
        if(roll.currentIteration == roll.maxrolls) {
            // show the final result for the current roll
            updateDiceImage(roll.currentRoll, roll.results[roll.currentRoll]);

            // reset iteration
            roll.currentIteration = 0;

            // move to the next roll if not at the end
            roll.currentRoll++;

            var total = 0;
            for(var i = 0; i < roll.currentRoll; i++) {
                total += roll.results[i];
            }
            $("#roll-total").html(total);

            if(roll.currentRoll < roll.results.length) {
                setTimeout(updateRolls, roll.timeout);
            }
        }
        else {
            // show the new roll
            roll.currentIteration++;
            updateDiceImage(roll.currentRoll, getRoll());
            setTimeout(updateRolls, roll.timeout);
        }
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

    $(function() {
        $("#roll-dice").click(function() {
            $("#dice-0").attr('src', '<?php echo $this->Html->url('/') . 'img/fate_magicblank.png';?>');
            $("#dice-1").attr('src', '<?php echo $this->Html->url('/') . 'img/fate_magicblank.png';?>');
            $("#dice-2").attr('src', '<?php echo $this->Html->url('/') . 'img/fate_magicblank.png';?>');
            $("#dice-3").attr('src', '<?php echo $this->Html->url('/') . 'img/fate_magicblank.png';?>');

            roll.results = [
                getRoll(),
                getRoll(),
                getRoll(),
                getRoll()
            ];
            roll.currentRoll = 0;
            roll.currentIteration = 0;
            $("#roll-total").html('0');
            setTimeout(updateRolls, roll.timeout);
        });
    });
</script>