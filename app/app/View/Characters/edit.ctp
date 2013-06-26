<?php /* @var View $this */ ?>
<?php /* @var array $skillSpreads */ ?>

<?php $this->set('title_for_layout', 'Edit '. $this->request->data['Character']['character_name']); ?>

<?php echo $this->Form->create('Character'); ?>
<div class="characters form">
    <table style="width:100%;">
        <tr>
            <td>
                <?php echo $this->Form->input('id'); ?>
                <?php echo $this->Form->input('character_name'); ?>
            </td>
            <td>
                <?php echo $this->Form->input('template_id'); ?>
            </td>
            <td style="width:100px">
                <?php echo $this->Form->input('power_level'); ?>
            </td>
            <td style="width:100px;">
                <?php echo $this->Form->input('max_fate', array('label' => 'Refresh')); ?>
            </td>
            <td style="width:100px;">
                <?php echo $this->Form->input('current_fate', array('label' => 'Fate')); ?>
            </td>
            <td>
                <?php echo $this->Form->input('character_status_id', array('label' => 'Status')); ?>
            </td>
        </tr>
    </table>
    <div id="tabs">
    <ul>
        <li><a href="#aspects">Aspects</a></li>
        <li><a href="#skills">Skills</a></li>
        <li><a href="#stunts">Stunts</a></li>
        <li><a href="#powers">Powers</a></li>
        <li><a href="#stress">Stress</a></li>
        <li><a href="#stories">Stories</a></li>
        <li><a href="#advancement">Advancement</a></li>
        <li><a href="#notes">Notes</a></li>
    </ul>
    <div id="aspects">
        <?php echo $this->Aspect->MakeEditTable($this->data); ?>
    </div>
    <div id="skills">
        <div class="paragraph">
            Points Remaining: <?php echo $this->Form->input('skill_points', array('readonly', 'value' => 30)); ?>
        </div>
        <div class="paragraph">
            <div id="add-skill" class='clickable'>Add Skill</div>
            <div id="sort-skills" class='clickable'>Sort Skills</div>
            <label>Default Skill Spread</label>
            <?php echo $this->Form->select('skill_spread', $skillSpreads); ?>
        </div>
        <div class="paragraph">
            <ul id="skill-list">
                <?php foreach(range(0, 15) as $i): ?>
                    <li>
                        <div class="input">
                            <?php
                            echo $this->Form->hidden("Character.$i.CharacterSkill.skill_id", array('class' => array('skill_name', 'field_hint'), 'fieldname' => 'Skill Name', 'value' => 'Skill Name', 'style' => 'color:#aaaaaa', 'label' => false, 'div' => false));
                            echo $this->Form->input("Character.$i.CharacterSkill.skill_name", array('class' => array('skill_name', 'field_hint'), 'fieldname' => 'Skill Name', 'value' => 'Skill Name', 'style' => 'color:#aaaaaa', 'label' => false, 'div' => false));
                            echo $this->Form->input("Character.$i.CharacterSkill.skill_level", array('class' => 'skill_level', 'value' => '0', 'label' => false, 'div' => false));
                            ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div id="stunts">
        <div class="paragraph">
            <div id="add-stunt" class='clickable'>Add Stunt</div>
            <div id="sort-stunts" class='clickable'>Sort Stunts</div>
        </div>
        <div class="paragraph">
            <ul id="stunt-list">
                <?php for($i = 0; $i < 5; $i++): ?>
                    <li>
                        <div class="input">
                            <?php
                            echo $this->Form->input("FateCharacter.$i.FateStunt.stunt_name", array('class' => array('stunt_name', 'field_hint'), 'fieldname' => 'Stunt Name', 'value' => 'Stunt Name', 'style' => 'color:#aaaaaa', 'label' => false, 'div' => false));
                            echo $this->Form->input("FateCharacter.$i.FateStunt.stunt_skill", array('class' => array('stunt_skill', 'field_hint', 'skill_name'), 'fieldname' => 'Stunt Skill', 'value' => 'Stunt Skill', 'style' => 'color:#aaaaaa', 'label' => false, 'div' => false));
                            echo $this->Form->input("FateCharacter.$i.FateStunt.stunt_rules", array('class' => array('stunt_rules', 'field_hint'), 'fieldname' => 'Stunt Rules', 'value' => 'Stunt Rules', 'style' => 'color:#aaaaaa', 'label' => false, 'div' => false));
                            echo $this->Form->input("FateCharacter.$i.FateStunt.refresh_cost", array('class' => 'refresh_cost', 'value' => '0', 'label' => false, 'div' => false));
                            ?>
                        </div>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
    <div id="powers">
        <div class="paragraph">
            <div id="add-power" class='clickable'>Add Power</div>
            <div id="sort-powers" class='clickable'>Sort Powers</div>
        </div>
        <div class="paragraph">
            <ul id="power-list">
                <?php for($i = 0; $i < 5; $i++): ?>
                    <li>
                        <div class="input">
                            <?php
                            echo $this->Form->input("Character.$i.FatePower.power_name", array('class' => array('power_name', 'field_hint'), 'fieldname' => 'Power Name', 'value' => 'Power Name', 'style' => 'color:#aaaaaa', 'label' => false, 'div' => false));
                            echo $this->Form->input("Character.$i.FatePower.refresh_cost", array('class' => 'refresh_cost', 'value' => '0', 'label' => false, 'div' => false));
                            ?>
                        </div>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
    <div id="stress">
        <div class="paragraph">
            <?php echo $this->Form->input('skill_id', array('label' => 'Physical Stress Skill')); ?>
            Physical Stress: <span id="physical-stress"></span><br />
            Extra Physical Consequences: <span id="extra-physical-consequences"></span>
        </div>
        <div class="paragraph">
            <?php echo $this->Form->input('skill_id', array('label' => 'Mental Stress Skill')); ?>
            Mental Stress: <span id="mental-stress"></span><br />
            Extra Mental Consequences: <span id="extra-mental-consequences"></span>
        </div>
        <div class="paragraph">
            <?php echo $this->Form->input('skill_id', array('label' => 'Social Stress Skill')); ?>
            Social Stress: <span id="social-stress"></span><br />
            Extra Social Consequences: <span id="extra-social-consequences"></span>
        </div>
    </div>
    <div id="stories">
        Stories your character has been, or is, involved in.<br />
        Also story management area where you can decide if people can have
        you as a connection.
    </div>
    <div id="advancement">
        A log of your character's Advancement
    </div>
    <div id="notes">
        Administrative Notes Area
    </div>
    </div>
</div>
<?php echo $this->Form->end(__('Submit')); ?>
<?php $this->start('javascript'); ?>
    <script type="text/javascript">
        $(function() {
            $("#tabs").tabs();
            $(".character-search").autocomplete({
                source: characterNames
            });
        });
    </script>
<?php $this->end(); ?>
