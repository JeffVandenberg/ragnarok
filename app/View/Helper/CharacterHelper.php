<?php

/**
 * Class CharacterHelper
 * @property FormHelper Form
 * @property AspectHelper Aspect
 * @property HtmlHelper Html
 */
class CharacterHelper extends AppHelper
{
    /**
     * @var array
     */
    public $helpers = array(
        'Html',
        'Form',
        'Aspect'
    );

    /**
     * @param $lists
     * @param $options
     * @return string
     */
    public function MakeCharacterEdit($lists, $options)
    {
        $defaults = array(
            'all' => false
        );

        $options = array_merge($defaults, $options);

        ob_start();
        foreach($lists as $listName => $list)
        {
            $$listName = $list;
        }
        /* @var array $skillSpreads */
        /* @var array $skills */
?>
        <table>
            <tr>
                <td>
                    <?php echo $this->Form->input('id'); ?>
                    <?php echo $this->Form->input('character_name', array('style' => 'width:400px;')); ?>
                </td>
                <td>
                    <?php echo $this->Form->input('template_id'); ?>
                </td>
                <td style="width:110px">
                    <?php echo $this->Form->input('power_level', array('readonly' => !$this->CheckOption($options, 'gm_edit'), 'style' => 'width: 50px;')); ?>
                </td>
                <td style="width:80px;">
                    <?php echo $this->Form->input('max_fate', array('label' => 'Refresh', 'readonly' => true, 'style' => 'width: 50px;')); ?>
                </td>
                <?php if($this->CheckOption($options, 'current_fate')): ?>
                    <td style="width:80px;">
                        <?php echo $this->Form->input('current_fate', array('label' => 'Fate', 'style' => 'width: 50px;')); ?>
                    </td>
                <?php endif; ?>
            </tr>
            <?php if($this->CheckOption($options, 'character_status')): ?>
                <tr>
                    <td colspan="5">
                        <?php echo $this->Form->input('character_status_id'); ?>
                    </td>
                </tr>
            <?php endif; ?>
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
                <li><a href="#notes">Admin</a></li>
            </ul>
            <div id="aspects">
                <?php echo $this->Aspect->MakeAddTable(); ?>
            </div>
            <div id="skills">
                <div class="paragraph">

                    <span class="input">
                        <label for="skill-points">Points Remaining:</label>
                        <input type="text" readonly value="30" id="skill-points"/>
                    </span>
                </div>
                <div class="paragraph">
                    <div id="add-skill" class='simple-button'>Add Skill</div>
                    <div id="sort-skills" class='simple-button'>Sort Skills</div>
                    <?php if($this->request->data['Character']['character_status_id'] == 1): ?>
                        <label>Default Skill Spread</label>
                        <?php echo $this->Form->select('skill_spread', $skillSpreads); ?>
                    <?php endif; ?>
                </div>
                <div class="paragraph">
                    <ul id="skill-list">
                        <?php $maxSize = (count($this->request->data['CharacterSkill']) > 20 ? count($this->request->data['CharacterSkill']) : 20); ?>
                        <?php foreach(range(0, $maxSize) as $i): ?>
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
                    <?php if($this->request->data['Character']['character_status_id'] == 1): ?>
                        <div id="apply-template" class='simple-button'>Apply Template</div>
                    <?php endif; ?>
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
            <div id="notes">
                <table>
                <?php if($this->CheckOption($options, 'gm_edit')): ?>
                    <tr>
                        <th>New Note</th>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $this->Form->input('CharacterGmNote.-1.note'); ?>
                        </td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <th>
                        Past Notes
                    </th>
                </tr>
                <?php foreach($this->request->data['CharacterGmNote'] as $characterGmNote): ?>
                    <tr>
                        <td>
                            <?php echo $characterGmNote['CreatedBy']['username']; ?>
                            on
                            <?php echo $characterGmNote['created']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $characterGmNote['note']; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </table>
            </div>
        </div>
<?php
        return ob_get_clean();
    }

    /**
     *
     */
    public function MakeCharacterView()
    {

    }

    private function CheckOption($options, $option)
    {
        return isset($options[$option]) && $options[$option];
    }
}