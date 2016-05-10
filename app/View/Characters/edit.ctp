<?php /* @var View $this */ ?>
<?php /* @var array $skillSpreads */ ?>
<?php $this->set('title_for_layout', 'Edit ' . $this->request->data['Character']['character_name']); ?>
<?php $this->start('script'); ?>
<?php echo $this->Html->script('df-character'); ?>
<?php echo $this->Html->script('tinymce/tinymce.min'); ?>
<?php echo $this->Html->script('tinymce/jquery.tinymce.min'); ?>
<?php $this->end(); ?>

<?php echo $this->Form->create('Character'); ?>
<div class="characters form">
    <table style="width:100%;">
        <tr>
            <td>
                <?php echo $this->Form->input('id'); ?>
                <?php echo $this->Form->input('character_name', array('style' => 'width:350px;')); ?>
            </td>
            <td>
                <?php echo $this->Form->input('template_id'); ?>
            </td>
            <td style="width:130px">
                    <?php echo $this->Form->input('power_level', array('readonly' => true, 'style' => 'width: 50px;')); ?>
            </td>
            <td style="width:130px">
                    <?php echo $this->Form->input('skill_level', array('readonly' => true, 'style' => 'width: 50px;')); ?>
            </td>
            <td style="width:100px;">
                <?php echo $this->Form->input('max_fate', array('label' => 'Refresh', 'readonly' => true, 'value' => 12, 'style' => 'width: 50px;')); ?>
            </td>
            <!--<td style="width:100px;">
                <?php echo $this->Form->input('current_fate', array('label' => 'Fate')); ?>
            </td>
            <td>
                <?php echo $this->Form->input('character_status_id', array('label' => 'Status')); ?>
            </td>-->
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
            <!--<li><a href="#stories">Stories</a></li>
            <li><a href="#advancement">Advancement</a></li>
            <li><a href="#notes">Notes</a></li>-->
        </ul>
        <div id="aspects">
            <?php echo $this->Aspect->MakeEditTable($this->data); ?>
        </div>
        <div id="skills">
            <div class="paragraph">
                Points Remaining:
            <span class="input">
                <input type="text" readonly value="35" id="skill-points"/>
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
                    <?php $maxSize = (count($this->request->data['CharacterSkill']) > 20 ? count($this->request->data['CharacterSkill']) : 20); ?>
                    <?php foreach (range(0, ($maxSize-1)) as $i): ?>
                        <li>
                            <div class="input">
                                <?php
                                echo $this->Form->hidden("CharacterSkill.$i.id");
                                echo $this->Form->hidden("CharacterSkill.$i.skill_id", array('class' => 'skill-id'));
                                echo $this->Form->input("CharacterSkill.$i.Skill.skill_name", array('class' => array('skill-name', 'field-hint'), 'fieldname' => 'Skill Name', 'label' => false, 'div' => false));
                                echo $this->Form->input("CharacterSkill.$i.skill_level", array('class' => 'skill-level', 'label' => false, 'div' => false));
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
                    <?php $maxSize = (count($this->request->data['CharacterStunt']) > 5 ? count($this->request->data['CharacterStunt']) : 5); ?>
                    <?php for ($i = 0; $i < $maxSize; $i++): ?>
                        <li>
                            <div class="input">
                                <?php
                                echo $this->Form->input("CharacterStunt.$i.id", array('label' => false, 'div' => false));
                                echo $this->Form->hidden("CharacterStunt.$i.stunt_id", array('class' => array('stunt-id'), 'label' => false, 'div' => false));
                                echo $this->Form->input("CharacterStunt.$i.Stunt.stunt_name", array('class' => array('stunt-name', 'field-hint'), 'fieldname' => 'Stunt Name', 'label' => false, 'div' => false));
                                echo $this->Form->input("CharacterStunt.$i.note", array('class' => array('stunt-note', 'field-hint'), 'fieldname' => 'Note', 'label' => false, 'div' => false));
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
                    <?php $maxSize = (count($this->request->data['CharacterPower']) > 5 ? count($this->request->data['CharacterPower']) : 5); ?>
                    <?php for ($i = 0; $i < $maxSize; $i++): ?>
                        <li>
                            <div class="input">
                                <?php
                                echo $this->Form->input("CharacterPower.$i.id");
                                echo $this->Form->hidden("CharacterPower.$i.power_id", array('class' => 'power-id'));
                                echo $this->Form->input("CharacterPower.$i.Power.power_name", array('class' => array('power-name', 'field-hint'), 'fieldname' => 'Power Name', 'label' => false, 'div' => false));
                                echo $this->Form->input("CharacterPower.$i.note", array('class' => array('power-note', 'field-hint'), 'fieldname' => 'Power Note', 'label' => false, 'div' => false));
                                echo $this->Form->input("CharacterPower.$i.refresh_cost", array('class' => 'refresh-cost', 'label' => false, 'div' => false));
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
            <div class="paragraph input">
                <?php echo $this->Form->input('physical_stress_skill_id', array('label' => 'Physical Stress Skill', 'options' => $skills)); ?>
                Physical Stress: <?php echo $this->Form->input('physical_stress', array('style' => 'width:50px;', 'readonly' => 'readonly', 'div' => false, 'label' => false)); ?><br />
                Extra Physical Consequences: <?php echo $this->Form->input('additional_physical_consequences', array('style' => 'width:50px;', 'readonly' => 'readonly', 'div' => false, 'label' => false)); ?>
            </div>
            <div class="paragraph input">
                <?php echo $this->Form->input('mental_stress_skill_id', array('label' => 'Mental Stress Skill', 'options' => $skills)); ?>
                Mental Stress: <?php echo $this->Form->input('mental_stress', array('style' => 'width:50px;', 'readonly' => 'readonly', 'div' => false, 'label' => false)); ?><br />
                Extra Mental Consequences: <?php echo $this->Form->input('additional_mental_consequences', array('style' => 'width:50px;', 'readonly' => 'readonly', 'div' => false, 'label' => false)); ?>
            </div>
            <div class="paragraph input">
                <?php echo $this->Form->input('social_stress_skill_id', array('label' => 'Social Stress Skill', 'options' => $skills)); ?>
                Social Stress: <?php echo $this->Form->input('social_stress', array('style' => 'width:50px;', 'readonly' => 'readonly', 'div' => false, 'label' => false)); ?><br />
                Extra Social Consequences: <?php echo $this->Form->input('additional_social_consequences', array('style' => 'width:50px;', 'readonly' => 'readonly', 'div' => false, 'label' => false)); ?>
            </div>
            <div class="paragraph input">
                <?php echo $this->Form->input('hunger_stress_skill_id', array('label' => 'Hunger Stress Skill', 'options' => $skills)); ?>
                Hunger Stress: <?php echo $this->Form->input('hunger_stress', array('style' => 'width:50px;', 'readonly' => 'readonly', 'div' => false, 'label' => false)); ?><br />
                Extra Hunger Consequences: <?php echo $this->Form->input('additional_hunger_consequences', array('style' => 'width:50px;', 'readonly' => 'readonly', 'div' => false, 'label' => false)); ?>
            </div>
        </div>
        <div id="description">
            <div class="input">
                Public Character Page. Put anything and everything you want people to know about your character here.
                <?php echo $this->Form->textarea('public_information', array('class' => 'full-editor')); ?>
            </div>
        </div>
    </div>
</div>
<div id="sheet-subview" style="display:none;"></div>
<?php echo $this->Form->end(__('Submit')); ?>
<?php $this->start('javascript'); ?>
<script type="text/javascript">
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
