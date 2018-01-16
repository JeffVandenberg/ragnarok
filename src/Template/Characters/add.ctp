<?php

use App\Model\Entity\Character;
use App\View\AppView;

/* @var AppView $this */
/* @var Character $character */
/* @var int $skillPoints */
/* @var $skillSpreads array */
/* @var $skills array */

$this->set('title_for_layout', 'Create Character');

$this->start('script');
echo $this->Html->script('df-character');
$this->end();

echo $this->Form->create($character);
?>
<table style="width:100%;">
    <tr>
        <td>
            <?php echo $this->Form->control('id'); ?>
            <?php echo $this->Form->control('character_name', array('style' => 'width:350px;')); ?>
        </td>
        <td>
            <?php echo $this->Form->control('template_id'); ?>
        </td>
        <td style="width:130px">
            <?php echo $this->Form->control('power_level', array('readonly' => true, 'style' => 'width: 50px;')); ?>
        </td>
        <td style="width:130px">
            <?php echo $this->Form->control('skill_level', array('readonly' => true, 'style' => 'width: 50px;')); ?>
        </td>
        <td style="width:100px;">
            <?php echo $this->Form->control('max_fate', array('label' => 'Refresh', 'readonly' => true, 'style' => 'width: 50px;')); ?>
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
        <!--        <li><a href="#stories">Stories</a></li>-->
        <!--        <li><a href="#advancement">Advancement</a></li>-->
        <!--        <li><a href="#notes">Admin</a></li>-->
    </ul>
    <div id="aspects" class="tab-pane">
        <?php echo $this->Aspect->MakeAddTable(); ?>
    </div>
    <div id="skills" class="tab-pane">
        <div class="paragraph">
            Points Remaining:
            <span class="input">
                <input type="text" readonly value="<?php echo $skillPoints; ?>" id="skill-points"/>
            </span>
        </div>
        <div class="paragraph">
            <div id="add-skill" class='simple-button'>Add Skill</div>
            <div id="sort-skills" class='simple-button'>Sort Skills</div>
        </div>
        <div class="paragraph">
            <ul id="skill-list">
                <?php foreach (range(0, 20) as $i): ?>
                    <li>
                        <div class="skill-row">
                            <?php
                            echo $this->Form->hidden("character_skills.$i.id");
                            echo $this->Form->hidden("character_skills.$i.skill_id", array('class' => 'skill-id'));
                            echo $this->Form->control(
                                "character_skills.$i.skill.skill_name",
                                [
                                    'class' => [
                                        'skill-name',
                                    ],
                                    'placeholder' => 'Skill Name',
                                    'label' => false,
                                    'required' => false
                                ]
                            );
                            echo $this->Form->control(
                                "character_skills.$i.skill_level",
                                [
                                    'class' => 'skill-level',
                                    'value' => '0',
                                    'label' => false,
                                ]
                            );
                            echo $this->Html->image('ragny_icon_search.png', array('class' => array('skill-view', 'clickable')));
                            ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div id="stunts" class="tab-pane">
        <div class="paragraph">
            <div id="add-stunt" class='simple-button'>Add Stunt</div>
            <div id="sort-stunts" class='simple-button'>Sort Stunts</div>
        </div>
        <div class="paragraph">
            <ul id="stunt-list">
                <?php for ($i = 0; $i < 5; $i++): ?>
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
                                ]
                            );
                            echo $this->Html->image('ragny_icon_search.png', ['class' => ['stunt-view', 'clickable']]);
                            ?>
                        </div>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
    <div id="powers" class="tab-pane">
        <div class="paragraph">
            <div id="add-power" class='simple-button'>Add Power</div>
            <div id="sort-powers" class='simple-button'>Sort Powers</div>
            <div id="apply-template" class='simple-button'>Apply Template</div>
        </div>
        <div class="paragraph">
            <ul id="power-list">
                <?php for ($i = 0; $i < 5; $i++): ?>
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
                                    'value' => '0',
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
    </div>
    <div id="powers2" class="tab-pane">
        This section is for notes which have a more complexity, such as your wereform's alternate skills and various
        magical bonuses, foci, etc.
        <?php echo $this->Form->control('additional_power_notes', [
            'required' => false
        ]); ?>
    </div>
    <div id="stress" class="tab-pane">
        <div class="paragraph input">
            <?php echo $this->Form->control(
                'physical_stress_skill_id',
                [
                    'label' => 'Physical Stress Skill',
                    'options' => $skills,
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
                        'stress-input'
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
                        'stress-input'
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
                    'options' => $skills,
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
                        'stress-input'
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
                        'stress-input'
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
                    'options' => $skills,
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
                        'stress-input'
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
                        'stress-input'
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
                    'options' => $skills,
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
                        'stress-input'
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
                        'stress-input'
                    ],
                    'templates' => [
                        'inputContainer' => '{{content}}'
                    ]
                ]); ?>
        </div>
    </div>
    <div id="description" class="tab-pane">
        <div class="input">
            Public Character Page. Put anything and everything you want people to know about your character here.
            <?php echo $this->Form->textarea('public_information', ['class' => 'full-editor', 'required' => false]); ?>
        </div>
    </div>
</div>
<div>
    <?php echo $this->Form->submit('Save', [
        'id' => 'form-submit'
    ]); ?>
</div>
<?php echo $this->Form->end(); ?>
<div id="sheet-subview" style="display:none;"></div>

<?php $this->start('javascript'); ?>
<script type="text/javascript">
    dfCharacter.skillPoints = <?php echo $skillPoints; ?>;
    dfCharacter.powerLevel = <?php echo $character->power_level; ?>;
</script>
<script type="text/javascript">
</script>
<?php $this->end(); ?>
