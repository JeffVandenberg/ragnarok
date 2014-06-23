<?php /* @var $this View */ ?>
<?php /* @var $skillSpreads array */ ?>
<?php /* @var $skills array */ ?>
<?php $this->set('title_for_layout', 'Create Character'); ?>
<?php $this->start('script'); ?>
<?php echo $this->Html->script('df-character'); ?>
<?php echo $this->Html->script('tinymce/tinymce.min'); ?>
<?php echo $this->Html->script('tinymce/jquery.tinymce.min'); ?>
<?php $this->end(); ?>
<?php $skillPoints = $this->request->data['Character']['skill_points']; ?>
<?php echo $this->Form->create('Character'); ?>
<table style="width:100%;">
    <tr>
        <td>
            <?php echo $this->Form->input('id'); ?>
            <?php echo $this->Form->input('character_name', array('style' => 'width:500px;')); ?>
        </td>
        <td>
            <?php echo $this->Form->input('template_id'); ?>
        </td>
        <td style="width:130px">
            <?php echo $this->Form->input('power_level', array('readonly' => true, 'style' => 'width: 50px;')); ?>
        </td>
        <td style="width:100px;">
            <?php echo $this->Form->input('max_fate', array('label' => 'Refresh', 'readonly' => true, 'style' => 'width: 50px;')); ?>
        </td>
    </tr>
</table>
<div id="tabs">
    <ul>
        <li><a href="#aspects">Aspects</a></li>
        <li><a href="#skills">Skills</a></li>
        <li><a href="#stunts">Stunts</a></li>
        <li><a href="#powers">Powers</a></li>
        <li><a href="#powers2">Power Notes</a></li>
        <li><a href="#stress">Stress</a></li>
        <li><a href="#description">Public</a></li>
<!--        <li><a href="#stories">Stories</a></li>-->
<!--        <li><a href="#advancement">Advancement</a></li>-->
<!--        <li><a href="#notes">Admin</a></li>-->
    </ul>
    <div id="aspects">
        <?php echo $this->Aspect->MakeAddTable(); ?>
    </div>
    <div id="skills">
        <div class="paragraph">
            Points Remaining:
            <span class="input">
                <input type="text" readonly value="<?php echo $skillPoints; ?>" id="skill-points" />
            </span>
        </div>
        <div class="paragraph">
            <div id="add-skill" class='simple-button'>Add Skill</div>
            <div id="sort-skills" class='simple-button'>Sort Skills</div>
            <label>Default Skill Spread</label>
            <?php echo $this->Form->select('skill_spread', $skillSpreads); ?>
        </div>
        <div class="paragraph">
            <ul id="skill-list">
                <?php foreach(range(0, 20) as $i): ?>
                    <li>
                        <div class="input">
                            <?php
                            echo $this->Form->hidden("CharacterSkill.$i.id");
                            echo $this->Form->hidden("CharacterSkill.$i.skill_id", array('class' => 'skill-id'));
                            echo $this->Form->input("CharacterSkill.$i.Skill.skill_name", array('class' => array('skill-name', 'field-hint'), 'fieldname' => 'Skill Name', 'value' => 'Skill Name', 'style' => 'color:#aaaaaa', 'label' => false, 'div' => false));
                            echo $this->Form->input("CharacterSkill.$i.skill_level", array('class' => 'skill-level', 'value' => '0', 'label' => false, 'div' => false));
                            echo $this->Html->image('ragny_icon_search.png', array('class' => array('skill-view', 'clickable'))); 
                            ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div id="stunts">
        <div class="paragraph">
            <div id="add-stunt" class='simple-button'>Add Stunt</div>
            <div id="sort-stunts" class='simple-button'>Sort Stunts</div>
        </div>
        <div class="paragraph">
            <ul id="stunt-list">
                <?php for ($i = 0; $i < 5; $i++): ?>
                    <li>
                        <div class="input">
                            <?php
                            echo $this->Form->input("CharacterStunt.$i.id", array('label' => false, 'div' => false));
                            echo $this->Form->hidden("CharacterStunt.$i.stunt_id", array('class' => array('stunt-id'), 'label' => false, 'div' => false));
                            echo $this->Form->input("CharacterStunt.$i.Stunt.stunt_name", array('class' => array('stunt-name', 'field-hint'), 'fieldname' => 'Stunt Name', 'value' => 'Stunt Name', 'style' => 'color:#aaaaaa', 'label' => false, 'div' => false));
                            echo $this->Form->input("CharacterStunt.$i.note", array('class' => array('stunt-note', 'field-hint'), 'fieldname' => 'Note', 'value' => 'Note', 'style' => 'color:#aaaaaa', 'label' => false, 'div' => false));
                            echo $this->Html->image('ragny_icon_search.png', array('class' => array('stunt-view', 'clickable')));
                            ?>
                        </div>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
    <div id="powers">
        <div class="paragraph">
            <div id="add-power" class='simple-button'>Add Power</div>
            <div id="sort-powers" class='simple-button'>Sort Powers</div>
            <div id="apply-template" class='simple-button'>Apply Template</div>
        </div>
        <div class="paragraph">
            <ul id="power-list">
                <?php for ($i = 0; $i < 5; $i++): ?>
                    <li>
                        <div class="input">
                            <?php
                            echo $this->Form->input("CharacterPower.$i.id");
                            echo $this->Form->hidden("CharacterPower.$i.power_id", array('class' => 'power-id'));
                            echo $this->Form->input("CharacterPower.$i.Power.power_name", array('class' => array('power-name', 'field-hint'), 'fieldname' => 'Power Name', 'value' => 'Power Name', 'style' => 'color:#aaaaaa', 'label' => false, 'div' => false));
                            echo $this->Form->input("CharacterPower.$i.note", array('class' => array('power-note', 'field-hint'), 'fieldname' => 'Power Note', 'value' => 'Power Note', 'style' => 'color:#aaaaaa', 'label' => false, 'div' => false));
                            echo $this->Form->input("CharacterPower.$i.refresh_cost", array('value' => '0', 'class' => 'refresh-cost', 'label' => false, 'div' => false));
                            echo $this->Html->image('ragny_icon_search.png', array('class' => array('power-view', 'clickable')));
                            ?>
                        </div>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
    <div id="powers2">
        This section is for notes which have a more complexity, such as your wereform's alternate skills and various
        magical bonuses, foci, etc.
        <?php echo $this->Form->input('additional_power_notes'); ?>
    </div>
    <div id="stress">
        <div class="paragraph">
            <?php echo $this->Form->input('physical_stress_skill_id', array('label' => 'Physical Stress Skill', 'options' => $skills)); ?>
            Physical Stress: <span id="physical-stress"></span><br />
            Extra Physical Consequences: <span id="extra-physical-consequences"></span>
        </div>
        <div class="paragraph">
            <?php echo $this->Form->input('mental_stress_skill_id', array('label' => 'Mental Stress Skill', 'options' => $skills)); ?>
            Mental Stress: <span id="mental-stress"></span><br />
            Extra Mental Consequences: <span id="extra-mental-consequences"></span>
        </div>
        <div class="paragraph">
            <?php echo $this->Form->input('social_stress_skill_id', array('label' => 'Social Stress Skill', 'options' => $skills)); ?>
            Social Stress: <span id="social-stress"></span><br />
            Extra Social Consequences: <span id="extra-social-consequences"></span>
        </div>
        <div class="paragraph">
            <?php echo $this->Form->input('hunger_stress_skill_id', array('label' => 'Hunger Stress Skill', 'options' => $skills)); ?>
            Hunger Stress: <span id="hunger-stress"></span><br />
            Extra Hunger Consequences: <span id="extra-hunger-consequences"></span>
        </div>
    </div>
    <div id="description">
        <div class="input">
            Public Character Page. Put anything and everything you want people to know about your character here.
            <?php echo $this->Form->textarea('public_information', array('class' => 'full-editor')); ?>
        </div>
    </div>
</div>
<?php echo $this->Form->end('Save'); ?>
<div id="sheet-subview" style="display:none;"></div>

<?php $this->start('javascript'); ?>
<script type="text/javascript">
    dfCharacter.skillPoints = <?php echo $skillPoints; ?>;
    dfCharacter.powerLevel = <?php echo $this->request->data['Character']['power_level']; ?>;
    initializeCharacter();
    $(function () {
        $("#tabs").tabs();
    });
</script>
<script type="text/javascript">
    tinymce.init({
        selector: "textarea.full-editor",
        theme: "modern",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor"
        ],
        toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        toolbar2: "print preview media | forecolor backcolor emoticons",
        image_advtab: true,
        height: 600
    });
</script>
<?php $this->end(); ?>