<?php
/**
 * Created by PhpStorm.
 * User: JeffVandenberg
 * Date: 1/12/2018
 * Time: 9:06 PM
 */

namespace App\View\Helper;


use App\Model\Entity\Character;
use App\Model\Entity\CharacterSkill;
use Cake\View\Helper\FormHelper;
use Cake\View\Helper\HtmlHelper;
use Cake\View\Helper\TextHelper;

/**
 * @property FormHelper Form
 * @property HtmlHelper Html
 * @property AspectHelper Aspect
 * @property TextHelper Text
 */
class CharacterHelper extends AppHelper
{
    public $helpers = [
        'Aspect',
        'Form',
        'Html',
        'Text'
    ];

    private $options = [
        'is_new' => false,
        'edit_protected' => false,
        'edit_gm' => false,
        'edit_full' => false,
        'edit_limited' => false,
    ];

    public function create(Character $character, array $options)
    {
        $this->options = array_merge($this->options, $options);

        if ($this->mayEditFull()) {
            $characterName = $this->Form->control('character_name', array('style' => 'width:350px;'));
            $template = $this->Form->control('template_id');
            $powerLevel = $this->Form->control('power_level', array('readonly' => true, 'style' => 'width: 50px;'));
            $skillLevel = $this->Form->control('skill_level', array('readonly' => true, 'style' => 'width: 50px;'));
            $maxFate = $this->Form->control('max_fate', array('label' => 'Refresh', 'readonly' => true, 'style' => 'width: 50px;'));
            $skillItemClass = 'character-skill-item';
        } else {
            $characterName = '<label>Character Name</label><br />' . $character->character_name;
            $template = '<label>Template</label><br />' . $character->template->template_name;
            $powerLevel = '<label>Power Level</label><br />' . $character->power_level;
            $skillLevel = '<label>Skill Level</label><br />' . $character->skill_level;
            $maxFate = '<label>Refresh</label><br />' . $character->max_fate;
            $skillItemClass = '';
        }

        if ($this->mayEditLimited()) {
            $currentFate = $this->Form->control('current_fate', array('label' => 'Fate', 'style' => 'width: 50px;'));
        } else {
            $currentFate = '<label>Current Fate</label><br />' . $character->current_fate;
        }

        if ($this->mayEditFull() || $this->mayEditLimited()) {
            $id = $this->Form->control('id');
        } else {
            $id = '';
        }

        if ($this->isGmEdit()) {
            $characterStatus = $this->Form->control('character_status_id');
        } else {
            $characterStatus =
                '<label>Status</label><br />' .
                (($character->character_status) ? $character->character_status->name : '');
        }

        if ($this->isNewSheet()) {
            $currentFate = '';
        }

        $characterSkillsByLevel = [];
        foreach ($character->character_skills as $skill) {
            $characterSkillsByLevel[$skill->skill_level][] = $skill;
        }

        ob_start();
        ?>
        <table>
            <tr>
                <td colspan="3">
                    <?php echo $id; ?>
                    <?php echo $characterName; ?>
                </td>
                <td colspan="2">
                    <?php echo $template; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $powerLevel; ?>
                </td>
                <td>
                    <?php echo $skillLevel; ?>
                </td>
                <td>
                    <?php echo $maxFate; ?>
                </td>
                <td>
                    <?php echo $currentFate; ?>
                </td>
                <td>
                    <?php echo $characterStatus; ?>
                </td>
            </tr>
        </table>
        <div id="tabs" class="tabs">
            <ul>
                <li><a href="#aspects">Aspects</a></li>
                <li><a href="#skills">Skills</a></li>
                <li><a href="#stunts">Stunts</a></li>
                <li><a href="#powers">Powers</a></li>
                <li><a href="#powers2">Power Notes</a></li>
                <li><a href="#stress">Stress</a></li>
                <li><a href="#description">Public</a></li>
                <?php if (!$this->isNewSheet()): ?>
                    <li><a href="#notes">Admin</a></li>
                <?php endif; ?>
            </ul>
            <div id="aspects" class="tab-pane">
                <?php if ($this->mayEditFull()): ?>
                    <?php echo $this->Aspect->MakeEditTable($character); ?>
                <?php else: ?>
                    <?php echo $this->Aspect->MakeViewTable($character); ?>
                <?php endif; ?>
            </div>
            <div id="skills" class="tab-pane">
                <?php if ($this->mayEditFull()): ?>
                    <div class="paragraph">
                        Points Remaining:
                        <span class="input">
                            <input type="text" readonly value="<?php echo $options['skill_points']; ?>"
                                   id="skill-points"/>
                        </span>
                    </div>
                    <div class="paragraph">
                        <input type="text" id="new-skill-name"/>
                        <input type="hidden" id="new-skill-id"/>
                        <div id="add-skill" class='simple-button'>Add Skill</div>
                    </div>
                    <div>
                        <strong>Put a skill in the +0 row to remove it.</strong>
                    </div>
                <?php endif; ?>
                <div id="skill-pyramid">
                    <?php $i = 0; ?>
                    <?php $low = ($this->mayEditFull()) ? 0 : 1; ?>
                    <?php foreach (range($options['max_skill_level'], $low, -1) as $level): ?>
                        <div id="skill-<?= $level; ?>-row" class="skill-row">
                            <div class="skill-row-level">+<?= $level; ?></div>
                            <ul class="skill-row-droplist">
                                <?php if (isset($characterSkillsByLevel[$level])): ?>
                                    <?php foreach ($characterSkillsByLevel[$level] as $skill): ?>
                                        <?php $row = $i++; ?>
                                        <li class="<?= $skillItemClass ?>">
                                            <?= $skill->skill->skill_name; ?>
                                            <?php if ($this->mayEditFull()): ?>
                                                <i class="ui-icon ui-icon-arrow-4 skill-drag-handle"></i>
                                                <?= $this->Form->hidden('character_skills.' . $row . '.skill_id', ['class' => 'skill-id']); ?>
                                                <?= $this->Form->hidden('character_skills.' . $row . '.skill_level', ['class' => 'skill-level']); ?>
                                                <?= $this->Form->hidden('character_skills.' . $row . '.id'); ?>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div id="stunts" class="tab-pane">
                <?php if ($this->mayEditFull()): ?>
                    <div class="paragraph">
                        <div id="add-stunt" class='simple-button'>Add Stunt</div>
                        <div id="sort-stunts" class='simple-button'>Sort Stunts</div>
                    </div>
                    <div class="paragraph">
                        <ul id="stunt-list">
                            <?php $maxSize = (count($character->character_stunts) > 5 ? count($character->character_stunts) : 5); ?>
                            <?php for ($i = 0; $i < $maxSize; $i++): ?>
                                <li>
                                    <div class="stunt-row">
                                        <?php
                                        echo $this->Form->control("character_stunts.$i.id", array('label' => false, 'div' => false));
                                        echo $this->Form->hidden("character_stunts.$i.stunt_id", array('class' => array('stunt-id'), 'label' => false, 'div' => false));
                                        echo $this->Form->control(
                                            "character_stunts.$i.stunt.stunt_name",
                                            [
                                                'class' => ['stunt-name'],
                                                'placeholder' => 'Stunt Name',
                                                'label' => false,
                                                'required' => false
                                            ]
                                        );
                                        echo $this->Form->control(
                                            "character_stunts.$i.note",
                                            [
                                                'class' => ['stunt-note'],
                                                'placeholder' => 'Note',
                                                'label' => false,
                                                'required' => false
                                            ]
                                        );
                                        echo $this->Html->image('ragny_icon_search.png', ['class' => ['stunt-view', 'clickable']]);
                                        ?>
                                    </div>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </div>
                <?php else: ?>
                    <table>
                        <tr>
                            <th>
                                Stunt
                            </th>
                            <th>
                                Note
                            </th>
                            <th>
                            </th>
                        </tr>
                        <?php foreach ($character->character_stunts as $characterStunt): ?>
                            <tr class="<?php echo ($characterStunt->stunt->is_approved) ? "official-item" : "unapproved-item"; ?> stunt-row">
                                <td style="min-width: 25%;">
                                    <?php echo $characterStunt->stunt->stunt_name; ?>
                                </td>
                                <td>
                                    <?php echo $characterStunt->note; ?>
                                </td>
                                <td>
                                    <div style="display: inline;">
                                        <?php echo $this->Form->hidden('stunt_id', array('class' => 'stunt-id', 'value' => $characterStunt->stunt_id)); ?>
                                        <?php echo $this->Html->image('ragny_icon_search.png', array('class' => array('stunt-view', 'clickable'))); ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>
            </div>
            <div id="powers" class="tab-pane">
                <?php if ($this->mayEditFull()): ?>
                    <div class="paragraph">
                        <div id="add-power" class='simple-button'>Add Power</div>
                        <div id="sort-powers" class='simple-button'>Sort Powers</div>
                        <div id="apply-template" class='simple-button'>Apply Template</div>
                    </div>
                    <div class="paragraph">
                        <ul id="power-list">
                            <?php $maxSize = (count($character->character_powers) > 5 ? count($character->character_powers) : 5); ?>
                            <?php for ($i = 0; $i < $maxSize; $i++): ?>
                                <li>
                                    <div class="power-row">
                                        <?php
                                        echo $this->Form->control("character_powers.$i.id");
                                        echo $this->Form->hidden("character_powers.$i.power_id", ['class' => 'power-id']);
                                        echo $this->Form->control(
                                            "character_powers.$i.power.power_name",
                                            [
                                                'class' => ['power-name'],
                                                'placeholder' => 'Power Name',
                                                'label' => false,
                                                'required' => false
                                            ]);
                                        echo $this->Form->control(
                                            "character_powers.$i.note",
                                            [
                                                'class' => ['power-note'],
                                                'placeholder' => 'Power Note',
                                                'label' => false,
                                                'required' => false
                                            ]);
                                        echo $this->Form->control(
                                            "character_powers.$i.refresh_cost",
                                            [
                                                'class' => 'refresh-cost',
                                                'label' => false,
                                            ]);
                                        echo $this->Html->image('ragny_icon_search.png', ['class' => ['power-view', 'clickable']]);
                                        ?>
                                    </div>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </div>
                <?php else: ?>
                    <table>
                        <tr>
                            <th>
                                Power
                            </th>
                            <th>
                                Note
                            </th>
                            <th>
                                Cost
                            </th>
                            <th>

                            </th>
                        </tr>
                        <?php foreach ($character->character_powers as $characterPower): ?>
                            <tr class="<?php echo ($characterPower->power->is_approved) ? "official-item" : "unapproved-item"; ?> power-row">
                                <td style="min-width: 25%;">
                                    <?php echo $characterPower->power->power_name; ?>
                                </td>
                                <td>
                                    <?php echo $characterPower->note; ?>
                                </td>
                                <td>
                                    <?php echo $characterPower->refresh_cost; ?>
                                </td>
                                <td>
                                    <div style="display: inline;">
                                        <?php echo $this->Form->hidden('power_id', array('class' => 'power-id', 'value' => $characterPower->power_id)); ?>
                                        <?php echo $this->Html->image('ragny_icon_search.png', array('class' => array('power-view', 'clickable'))); ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>
            </div>
            <div id="powers2" class="tab-pane">
                This section is for notes which have a more complexity, such as your wereform's alternate skills and
                various magical bonuses, foci, etc.
                <?php if ($this->mayEditFull()): ?>
                    <?php echo $this->Form->control('additional_power_notes'); ?>
                <?php else: ?>
                    <?php echo $this->Text->autoParagraph($character->additional_power_notes); ?>
                <?php endif; ?>
            </div>
            <div id="stress" class="tab-pane">
                <?php if ($this->mayEditFull()): ?>
                    <div class="paragraph input">
                        <?php echo $this->Form->control(
                            'physical_stress_skill_id',
                            [
                                'label' => 'Physical Stress Skill',
                                'options' => $options['skills'],
                                'class' => [
                                    'stress-selector'
                                ],
                                'templates' => [
                                    'inputContainer' => '{{content}}'
                                ]
                            ]); ?>
                        Physical Stress: <?php echo $this->Form->control(
                            'physical_stress',
                            [
                                'readonly' => 'readonly',
                                'label' => false,
                                'class' => [
                                    'stress-display-box'
                                ],
                                'templates' => [
                                    'inputContainer' => '{{content}}'
                                ]
                            ]); ?>
                        Extra Physical Consequences: <?php echo $this->Form->control(
                            'additional_physical_consequences',
                            [
                                'readonly' => 'readonly',
                                'label' => false,
                                'class' => [
                                    'stress-display-box'
                                ],
                                'templates' => [
                                    'inputContainer' => '{{content}}'
                                ]
                            ]); ?>
                    </div>
                    <div class="paragraph input">
                        <?php echo $this->Form->control(
                            'mental_stress_skill_id',
                            [
                                'label' => 'Mental Stress Skill',
                                'options' => $options['skills'],
                                'class' => [
                                    'stress-selector'
                                ],
                                'templates' => [
                                    'inputContainer' => '{{content}}'
                                ]
                            ]); ?>
                        Mental Stress: <?php echo $this->Form->control(
                            'mental_stress',
                            [
                                'readonly' => 'readonly',
                                'label' => false,
                                'class' => [
                                    'stress-display-box'
                                ],
                                'templates' => [
                                    'inputContainer' => '{{content}}'
                                ]
                            ]); ?>
                        Extra Mental Consequences: <?php echo $this->Form->control(
                            'additional_mental_consequences',
                            [
                                'readonly' => 'readonly',
                                'label' => false,
                                'class' => [
                                    'stress-display-box'
                                ],
                                'templates' => [
                                    'inputContainer' => '{{content}}'
                                ]
                            ]); ?>
                    </div>
                    <div class="paragraph input">
                        <?php echo $this->Form->control(
                            'social_stress_skill_id',
                            [
                                'label' => 'Social Stress Skill',
                                'options' => $options['skills'],
                                'class' => [
                                    'stress-selector'
                                ],
                                'templates' => [
                                    'inputContainer' => '{{content}}'
                                ]
                            ]); ?>
                        Social Stress: <?php echo $this->Form->control(
                            'social_stress',
                            [
                                'readonly' => 'readonly',
                                'label' => false,
                                'class' => [
                                    'stress-display-box'
                                ],
                                'templates' => [
                                    'inputContainer' => '{{content}}'
                                ]
                            ]); ?>
                        Extra Social Consequences: <?php echo $this->Form->control(
                            'additional_social_consequences',
                            [
                                'readonly' => 'readonly',
                                'label' => false,
                                'class' => [
                                    'stress-display-box'
                                ],
                                'templates' => [
                                    'inputContainer' => '{{content}}'
                                ]
                            ]); ?>
                    </div>
                    <div class="paragraph input">
                        <?php echo $this->Form->control(
                            'hunger_stress_skill_id',
                            [
                                'label' => 'Hunger Stress Skill',
                                'options' => $options['skills'],
                                'class' => [
                                    'stress-selector'
                                ],
                                'templates' => [
                                    'inputContainer' => '{{content}}'
                                ]
                            ]); ?>
                        Hunger Stress: <?php echo $this->Form->control(
                            'hunger_stress',
                            [
                                'readonly' => 'readonly',
                                'label' => false,
                                'class' => [
                                    'stress-display-box'
                                ],
                                'templates' => [
                                    'inputContainer' => '{{content}}'
                                ]
                            ]); ?>
                        Extra Hunger Consequences: <?php echo $this->Form->control(
                            'additional_hunger_consequences',
                            [
                                'readonly' => 'readonly',
                                'label' => false,
                                'class' => [
                                    'stress-display-box'
                                ],
                                'templates' => [
                                    'inputContainer' => '{{content}}'
                                ]
                            ]); ?>
                    </div>
                <?php else: ?>
                    <div class="paragraph">
                        <label>Physical Stress Skill</label><br/>
                        <?php echo $character->physical_stress_skill->skill_name; ?><br/>
                        Physical Stress: <?php echo $character->physical_stress; ?><br/>
                        Extra Physical Consequences: <?php echo $character->additional_physical_consequences; ?>
                    </div>
                    <div class="paragraph">
                        <label>Mental Stress Skill</label><br/>
                        <?php echo $character->mental_stress_skill->skill_name; ?><br/>
                        Mental Stress: <?php echo $character->mental_stress; ?><br/>
                        Extra Mental Consequences: <?php echo $character->additional_mental_consequences; ?>
                    </div>
                    <div class="paragraph">
                        <label>Social Stress Skill</label><br/>
                        <?php echo $character->social_stress_skill->skill_name; ?><br/>
                        Social Stress: <?php echo $character->social_stress; ?><br/>
                        Extra Social Consequences: <?php echo $character->additional_social_consequences; ?>
                    </div>
                    <div class="paragraph">
                        <label>Hunger Stress Skill</label><br/>
                        <?php echo $character->hunger_stress_skill->skill_name; ?><br/>
                        Hunger Stress: <?php echo $character->hunger_stress; ?><br/>
                        Extra Hunger Consequences: <?php echo $character->additional_hunger_consequences; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div id="description" class="tab-pane">
                <div class="input">
                    Public Character Page. Put anything and everything you want people to know about your character
                    here.
                    <?php if ($this->mayEditFull() || $this->mayEditLimited()): ?>
                        <?php echo $this->Form->textarea('public_information', array('class' => 'full-editor')); ?>
                    <?php else: ?>
                        <?php echo $character->public_information; ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php if (!$this->isNewSheet()): ?>
                <div id="notes" class="tab-pane">
                    <table>
                        <?php if ($this->isGmEdit()): ?>
                            <tr>
                                <th>New Note</th>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo $this->Form->control('character_gm_notes.-1.note'); ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <th>
                                Past Notes
                            </th>
                        </tr>
                        <?php foreach ($character->character_gm_notes as $characterGmNote): ?>
                            <tr>
                                <td>
                                    <?php echo $characterGmNote->created_by->username; ?>
                                    on
                                    <?php echo $characterGmNote->created; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo $this->Text->autoParagraph($characterGmNote->note); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php endif; ?>
        </div>
        <?php if (isset($options['skills'])): ?>
        <script>
            dfCharacter.skills = <?php echo $this->formatSkillsForJson($options['skills']); ?>;
        </script>
    <?php endif; ?>
        <?php
        return ob_get_clean();
    }

    private function mayEditLimited()
    {
        return $this->options['edit_full'] || $this->options['edit_limited'];
    }

    private function mayEditFull()
    {
        return $this->options['edit_full'];
    }

    private function isNewSheet()
    {
        return $this->options['is_new'];
    }

    private function isGmEdit()
    {
        return $this->options['edit_gm'];
    }

    private function formatSkillsForJson($skills)
    {
        $list = [];
        foreach ($skills as $key => $value) {
            $list[] = [
                'label' => $value,
                'value' => $key
            ];
        }
        return json_encode($list);
    }
}
