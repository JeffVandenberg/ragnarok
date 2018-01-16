<?php

use App\Model\Entity\Character;
use App\View\AppView;

/* @var Character $character */
/* @var AppView $this */

$this->set('title_for_layout', $character->character_name);

$this->start('script');
echo $this->Html->script('df-character');
$this->end(); ?>

<table style="width:100%;">
    <tr>
        <td>
            <label>Character Name</label><br/>
            <?php echo $character->character_name; ?>
        </td>
        <td>
            <label>Template</label><br/>
            <?php echo $character->template->template_name; ?>
        </td>
        <td style="width:100px">
            <label>Power Level</label><br/>
            <?php echo $character->power_level; ?>
        </td>
        <td style="width:100px;">
            <label>Refresh</label><br/>
            <?php echo $character->max_fate; ?>
        </td>
        <td style="width:100px;">
            <label>Fate Points</label><br/>
            <?php echo $character->current_fate; ?>
        </td>
        <td style="width:100px;">
            <label>Status</label><br/>
            <?php echo $character->character_status->name; ?>
        </td>
    </tr>
    <tr>
        <td>
            <label>Updated By</label><br/>
            <?php echo $character->updated_by->username; ?>
        </td>
        <td>
            <label>Updated On</label><br/>
            <?php echo $character->updated; ?>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>
<div id="tabs">
    <ul class="tabs" data-tabs id="character-sheet-tabs">
        <li class="tabs-title is-active"><a href="#aspects">Aspects</a></li>
        <li class="tabs-title"><a href="#skills">Skills</a></li>
        <li class="tabs-title"><a href="#stunts">Stunts</a></li>
        <li class="tabs-title"><a href="#powers">Powers</a></li>
        <li class="tabs-title"><a href="#powers2">Power Notes</a></li>
        <li class="tabs-title"><a href="#stress">Stress</a></li>
        <li class="tabs-title"><a href="#description">Public</a></li>
    </ul>
    <div class="tabs-panel is-active" id="aspects">
        <?php echo $this->Aspect->MakeViewTable($character); ?>
    </div>
    <div class="tabs-panel" id="skills">
        <table>
            <tr>
                <th>
                    Skill
                </th>
                <th>
                    Level
                </th>
            </tr>
            <?php foreach ($character->character_skills as $characterSkill): ?>
                <tr class="skill-row">
                    <td style="min-width: 25%;">
                        <?php echo $characterSkill->skill->skill_name; ?>
                    </td>
                    <td>
                        <?php echo $characterSkill->skill_level; ?>
                    </td>
                    <td>
                        <div style="display: inline;">
                            <?php echo $this->Form->hidden('skill_id', array('class' => 'skill-id', 'value' => $characterSkill->skill_id)); ?>
                            <?php echo $this->Html->image('ragny_icon_search.png', array('class' => array('skill-view', 'clickable'))); ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <div class="tabs-panel" id="stunts">
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
    </div>
    <div class="tabs-panel" id="powers">
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
    </div>
    <div class="tabs-panel" id="powers2">
        <div class="paragraph">
            This section is for notes which have a more complexity, such as your wereform's alternate skills and
            various magical bonuses, foci, etc.
        </div>
        <?php echo $this->Text->autoParagraph($character->additional_power_notes); ?>
    </div>
    <div class="tabs-panel" id="stress">
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
    </div>
    <div class="tabs-panel" id="description">
        <div class="input">
            <div class="paragraph">
                Public Character Page. Put anything and everything you want people to know about your character
                here.
            </div>
            <?php echo $character->public_information; ?>
        </div>
    </div>
</div>
<div id="sheet-subview" style="display:none;"></div>

<?php $this->start('javascript'); ?>
<script type="text/javascript">
    $(function () {
        $("#tabs").tabs();
    });
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
