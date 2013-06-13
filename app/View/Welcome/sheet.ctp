<?php /* @var View $this */ ?>
<?php /* @var array $skillSpreads */ ?>
<?php $this->set('title_for_layout', 'Test Sheet'); ?>

    <table style="width:100%;">
    <tr>
        <td>
            <div class="input">
                <?php echo $this->Form->input('character_name'); ?>
            </div>
        </td>
        <td style="width:100px">
            <div class="input">
                <label for="power-level">
                    Power Level
                </label>
                <input type="text" class="text" id="power-level" value="8" readonly="readonly">
            </div>
        </td>
        <td style="width:100px;">
            <div class="input">
                <label for="refresh">
                    Refresh
                </label>
                <input type="text" class="text" id="refresh" value="8" readonly="readonly">
            </div>
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
        <table>
            <tr class="row-0">
                <td colspan="3">
                    <div class="aspect">
                        High Concept
                    </div>
                </td>
            </tr>
            <tr class="row-0">
                <td colspan="3">
                    <div class="input required">
                        <label class="hover" hovertext="Required Field">
                            Aspect
                        </label>
                        <input type="text" class="text">
                    </div>
                </td>
            </tr>
            <tr class="row-1">
                <td colspan="3">
                    <div class="aspect">
                        Trouble
                    </div>
                </td>
            </tr>
            <tr class="row-1">
                <td colspan="3">
                    <div class="input">
                        <label>
                            Aspect
                        </label>
                        <input type="text" class="text">
                    </div>
                </td>
            </tr>
            <tr class="row-0">
                <td colspan="3">
                    <div class="aspect">
                        Background
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="input">
                        <label>
                            Aspect
                        </label>
                        <input type="text" class="text">
                    </div>
                </td>
                <td>
                    <div class="input">
                        <label>
                            Events
                        </label>
                        <textarea class="textarea"></textarea>
                    </div>
                </td>
            </tr>
            <tr class="row-1">
                <td colspan="3">
                    <div class="aspect">
                        Rising Conflict
                    </div>
                </td>
            </tr>
            <tr class="row-1">
                <td>
                    <div class="input">
                        <label>
                            Aspect
                        </label>
                        <input type="text" class="text">
                    </div>
                </td>
                <td>
                    <div class="input">
                        <label>
                            Events
                        </label>
                        <textarea class="textarea"></textarea>
                    </div>
                </td>
                <td></td>
            </tr>
            <tr class="row-0">
                <td colspan="3">
                    <div class="aspect">
                        The Story
                    </div>
                </td>
            </tr>
            <tr class="row-0">
                <td>
                    <div class="input">
                        <label>
                            Aspect
                        </label>
                        <input type="text" class="text">
                    </div>
                </td>
                <td>
                    <div class="input">
                        <label>
                            Events
                        </label>
                        <textarea class="textarea"></textarea>
                    </div>
                </td>
                <td>
                </td>
            </tr>
            <tr class="row-1">
                <td colspan="3">
                    <div class="aspect">
                        Guest Star
                    </div>
                </td>
            </tr>
            <tr class="row-1">
                <td>
                    <div class="input">
                        <label>
                            Aspect
                        </label>
                        <input type="text" class="text">
                    </div>
                </td>
                <td>
                    <div class="input">
                        <label>
                            Events
                        </label>
                        <textarea class="textarea"></textarea>
                    </div>
                </td>
                <td>
                    <div class="input">
                        <label>
                            Character
                        </label>
                        <input type="text" class="text character-autocomplete" />
                    </div>
                    <div class="input">
                        <label>
                            Story
                        </label>
                        <input type="text" class="text story-autocomplete" />
                    </div>
                </td>
            </tr>
            <tr class="row-0">
                <td colspan="3">
                    <div class="aspect">
                        Guest Star Redux
                    </div>
                </td>
            </tr>
            <tr class="row-0">
                <td>
                    <div class="input">
                        <label>
                            Aspect
                        </label>
                        <input type="text" class="text">
                    </div>
                </td>
                <td>
                    <div class="input">
                        <label>
                            Events
                        </label>
                        <textarea class="textarea"></textarea>
                    </div>
                </td>
                <td>
                    <div class="input">
                        <label>
                            Character
                        </label>
                        <input type="text" class="text character-autocomplete" />
                    </div>
                    <div class="input">
                        <label>
                            Story
                        </label>
                        <input type="text" class="text story-autocomplete" />
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div id="skills">
        <div class="paragraph">
            Points Remaining: <?php echo $this->Form->text('skill_points', array('readonly', 'value' => 30)); ?>
        </div>
        <div class="paragraph">
            <div id="add-skill" class='clickable'>Add Skill</div>
            <div id="sort-skills" class='clickable'>Sort Skills</div>
            <label>Default Skill Spread</label>
            <?php echo $this->Form->select('skill_spread', $skillSpreads); ?>
        </div>
        <div class="paragraph">
            <ul id="skill-list">
                <?php for($i = 0; $i < 15; $i++): ?>
                    <li>
                        <div class="input">
                            <?php
                            echo $this->Form->input("FateCharacter.$i.FateSkill.skill_name", array('class' => array('skill_name', 'field_hint'), 'fieldname' => 'Skill Name', 'value' => 'Skill Name', 'style' => 'color:#aaaaaa', 'label' => false, 'div' => false));
                            echo $this->Form->input("FateCharacter.$i.FateSkill.skill_level", array('class' => 'skill_level', 'value' => '0', 'label' => false, 'div' => false));
                            ?>
                        </div>
                    </li>
                <?php endfor; ?>
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
                            echo $this->Form->input("FateCharacter.$i.FatePower.power_name", array('class' => array('power_name', 'field_hint'), 'fieldname' => 'Power Name', 'value' => 'Power Name', 'style' => 'color:#aaaaaa', 'label' => false, 'div' => false));
                            echo $this->Form->input("FateCharacter.$i.FatePower.refresh_cost", array('class' => 'refresh_cost', 'value' => '0', 'label' => false, 'div' => false));
                            ?>
                        </div>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
    <div id="stress">
        <div class="paragraph">
            Physical Stress: <span id="physical-stress"></span><br />
            Extra Physical Consequences: <span id="extra-physical-consequences"></span>
        </div>
        <div class="paragraph">
            Mental Stress: <span id="mental-stress"></span><br />
            Extra Mental Consequences: <span id="extra-mental-consequences"></span>
        </div>
        <div class="paragraph">
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

<?php $this->start('javascript'); ?>
<script type="text/javascript">
    var characterNames = [
        "Abe",
        "Bob",
        "Carl",
        "Dan",
        "Edward",
        "Frank",
        "George",
        "Harry",
        "Isaac",
        "Jackob",
        "Karl",
        "Leonard",
        "Manny",
        "Nicholas",
        "OName",
        "Peter",
        "Reginald",
        "Steve",
        "Terry",
        "UName",
        "VName",
        "William",
        "Xander",
        "Yanny",
        "Zazzz"
    ];
    $(function() {
        $("#tabs").tabs();
        $(".character-autocomplete").autocomplete({
            source: characterNames
        });
    });
</script>
<?php $this->end(); ?>
<?php $this->start('javascript'); ?>
<script type="text/javascript">
    var fateCharacter = {};
    fateCharacter.skillPoints = 30;
    fateCharacter.powerLevel = 8;
    fateCharacter.baseMentalStress = 2;
    fateCharacter.basePhysicalStress = 2;
    fateCharacter.baseSocialStress = 2;
    fateCharacter.calculateStressModifier = function (skillValue) {
        var modifier = 0;
        if ((skillValue >= 1) && (skillValue <= 2)) {
            modifier = 1
        }
        if (skillValue >= 3) {
            modifier = 2
        }
        return modifier;
    };
    fateCharacter.calculateExtraConsequence = function (skillValue) {
        var modifier = 0;
        if(skillValue > 4) {
            modifier = Math.ceil((skillValue - 4) / 2);
        }
        return modifier;
    };

    fateCharacter.skillList = new Array(
        'Alertness',
        'Athletics',
        'Burglary',
        'Contacts',
        'Conviction',
        'Craftsmanship',
        'Deceit',
        'Discipline',
        'Driving',
        'Empathy',
        'Endurance',
        'Fists',
        'Guns',
        'Intimidation',
        'Investigation',
        'Lore',
        'Might',
        'Performance',
        'Presence',
        'Rapport',
        'Scholarship',
        'Stealth',
        'Survival',
        'Weapons'
    );

    function updateSkills() {
        var mentalStress = fateCharacter.baseMentalStress;
        var physicalStress = fateCharacter.basePhysicalStress;
        var socialStress = fateCharacter.baseSocialStress;
        var extraMentalConsequence = 0;
        var extraPhysicalConsequence = 0;
        var extraSocialConsequence = 0;

        $(".skill_name").each(function(row, item) {
            var skillValue = $(item).parent('div').find('.skill_level').val();

            if($(item).val() == 'Conviction') {
                mentalStress += fateCharacter.calculateStressModifier(skillValue);
                extraMentalConsequence = fateCharacter.calculateExtraConsequence(skillValue);
            }
            if($(item).val() == 'Discipline') {

            }
            if($(item).val() == 'Endurance') {
                physicalStress += fateCharacter.calculateStressModifier(skillValue);
                extraPhysicalConsequence = fateCharacter.calculateExtraConsequence(skillValue);
            }
            if($(item).val() == 'Presence') {
                socialStress += fateCharacter.calculateStressModifier(skillValue);
                extraSocialConsequence = fateCharacter.calculateExtraConsequence(skillValue);
            }
        });

        $("#mental-stress").html(mentalStress);
        $("#extra-mental-consequences").html(extraMentalConsequence);
        $("#physical-stress").html(physicalStress);
        $("#extra-physical-consequences").html(extraPhysicalConsequence);
        $("#social-stress").html(socialStress);
        $("#extra-social-consequences").html(extraSocialConsequence);
    }

    function initializeCharacter() {
        updateSkills();
    }

    $(function () {
        initializeCharacter();

        $(".clickable").button();

        $("#add-skill").click(function () {
            var newItem = $("<li></li>");
            var newContent = $("<div></div>").addClass('input');
            var skillName = $("<input />").addClass('skill_name').attr('name', 'skill_name[]').val('Skill Name').css('color', '#aaaaaa');
            var skillLevel = $("<input />").addClass('skill_level').attr('name', 'skill_level[]').val(0);
            newItem.append(
                newContent.append(skillName).append(skillLevel)
            );
            $("#skill-list").append(newItem);
        });

        $("#add-power").click(function () {
            var newItem = $("<li></li>");
            var newContent = $("<div></div>").addClass('input');
            var skillName = $("<input />").addClass('power_name').addClass('field_hint').attr('fieldname', 'Power Name').attr('name', 'power_name[]').val('Power Name').css('color', '#aaaaaa');
            var skillLevel = $("<input />").addClass('refresh_cost').attr('name', 'refresh_cost[]').val(0);
            newItem.append(
                newContent.append(skillName).append(skillLevel)
            );
            $("#power-list").append(newItem);
        });

        $("#add-stunt").click(function () {
            var newItem = $("<li></li>");
            var newContent = $("<div></div>").addClass('input');
            var stuntName = $("<input />").addClass('stunt_name').addClass('field_hint').attr('fieldname', 'Stunt Name').attr('name', 'stunt_name[]').val('Stunt Name').css('color', '#aaaaaa');
            var stuntSkill = $("<input />").addClass('stunt_skill').addClass('field_hint').attr('fieldname', 'Stunt Skill').attr('name', 'stunt_skill[]').val('Stunt Skill').css('color', '#aaaaaa');
            var stuntRules = $("<input />").addClass('stunt_rules').addClass('field_hint').attr('fieldname', 'Stunt Rules').attr('name', 'stunt_rules[]').val('Stunt Rules').css('color', '#aaaaaa');
            var cost = $("<input />").addClass('refresh_cost').attr('name', 'refresh_cost[]').val(0);
            newItem.append(
                newContent.append(stuntName).append(stuntSkill).append(stuntRules).append(cost)
            );
            $("#stunt-list").append(newItem);
        });

        var focusItem = null;
        $(document).on('focus', 'input', function() {
            focusItem = $(this);
        });

        $(document).on('keyup', function(e){
            //alert(e.which);
            if(focusItem != null) {
                var firstClass = focusItem.classList()[0];
                if(e.which == 37) {
                    $(focusItem).prev().focus();
                }
                if(e.which == 38) {
                    $(focusItem).closest('li').prev().find('.' + firstClass).focus();
                }
                if(e.which == 39) {
                    $(focusItem).next().focus();
                }
                if(e.which == 40) {
                    $(focusItem).closest('li').next().find('.' + firstClass).focus();
                }
            }
        });

        $("#sort-skills").click(function() {
            sortSkills();
        });

        $("#sort-powers").click(function() {
            var powers = [];
            $("#power-list").find("li").each(function(count, item) {
                var item = {};
                item.name = $(this).find('.power_name').val();
                item.cost = $(this).find('.refresh_cost').val();
                powers.push(item);
            });
            powers.sort(function(a, b) {
                if(b.name == 'Power Name') { return -1; }
                if(a.name == 'Power Name') { return 1; }
                if(a.name < b.name) { return - 1; }
                if(b.name < a.name) { return 1; }
                return 0;
            });
            var row = 0;
            $("#power-list").find("li").each(function(count, item) {
                $(item).find('.power_name').val(powers[row].name);
                $(item).find('.refresh_cost').val(powers[row].cost);
                if($(item).find('.power_name').val() == 'Power Name') {
                    $(item).find('.power_name').css('color', '#aaaaaa');
                }
                else {
                    $(item).find('.power_name').css('color', '#000000');
                }
                row++;
            });
        });

        $("#sort-stunts").click(function() {
            var stunts = [];
            $("#stunt-list").find("li").each(function(count, item) {
                var item = {};
                item.name = $(this).find('.stunt_name').val();
                item.skill = $(this).find('.stunt_skill').val();
                item.rules = $(this).find('.stunt_rules').val();
                item.cost = $(this).find('.refresh_cost').val();
                stunts.push(item);
            });
            stunts.sort(function(a, b) {
                if(b.name == 'Stunt Name') { return -1; }
                if(a.name == 'Stunt Name') { return 1; }
                if(a.name < b.name) { return - 1; }
                if(b.name < a.name) { return 1; }
                return 0;
            });
            var row = 0;
            $("#stunt-list").find("li").each(function(count, item) {
                $(item).find('.stunt_name').val(stunts[row].name);
                $(item).find('.stunt_skill').val(stunts[row].skill);
                $(item).find('.stunt_rules').val(stunts[row].rules);
                $(item).find('.refresh_cost').val(stunts[row].cost);
                if($(item).find('.stunt_name').val() == 'Stunt Name') {
                    $(item).find('.stunt_name').css('color', '#aaaaaa');
                }
                else {
                    $(item).find('.stunt_name').css('color', '#000000');
                }
                row++;
            });
        });

        $(document)
            .on('focus', '.field_hint', function (e) {
                if ($(this).val() == $(this).attr('fieldname')) {
                    $(this).val('').css('color', '#000000');
                }
            })
            .on('blur', '.field_hint', function (e) {
                if ($.trim($(this).val()) == '') {
                    $(this).val($(this).attr('fieldname')).css('color', '#aaaaaa');
                }
            });

        $("#skill_spread").change(function() {
            // initialize
            $(".skill_level").val(0);
            $(".skill_name").val('Skill Name').css('color', '#aaaaaa');

            // set values
            var skillSpread = $(this).find(":selected").text();
            var row = 0;
            var skillLevel = 1;

            while(skillSpread != '') {
                var slashPosition = skillSpread.lastIndexOf('/');
                var numberOfSkills = skillSpread.substring(slashPosition + 1);
                for(var i = 0; i < numberOfSkills; i++) {
                    $("#FateCharacter" + row++ + "FateSkillSkillLevel").val(skillLevel);
                }
                skillSpread = skillSpread.substring(0, slashPosition);
                skillLevel++;
            }
            sortSkills();
        });

        $(document)
            .off('blur', '.skill_level')
            .on('blur', '.skill_level', function () {
                checkSkills();
                updateSkills();
            });

        $(document)
            .off('blur', '.refresh_cost')
            .on('blur', '.refresh_cost', function() {
                checkRefresh();
            });
    });

    function checkSkills() {
        var remainingPoints = fateCharacter.skillPoints;

        var levels = [0, 0, 0, 0, 0, 0, 0, 0];
        $('.skill_level')
            .each(function (count, item) {
                if (!isNaN(parseInt($(item).val()))) {
                    levels[$(item).val()] = levels[$(item).val()] + 1;
                }
                else {

                }
            })
            .each(function (count, item) {
                if (!isNaN(parseInt($(item).val()))) {
                    if (($(item).val() != 1) && (levels[$(item).val()] > levels[$(item).val() - 1])) {
                        $(this).css('background-color', '#ccbbbb');
                    }
                    else {
                        $(this).css('background-color', '');
                    }
                    remainingPoints = remainingPoints - $(this).val();
                }
                else {
                    $(this).css('background-color', '');
                }
            });
        $("#skill_points").val(remainingPoints);
    }

    function checkRefresh() {
        var remainingRefresh = fateCharacter.powerLevel;

        $('.refresh_cost')
            .each(function (count, item) {
                if (!isNaN(parseInt($(item).val()))) {
                    remainingRefresh -= $(item).val();
                }
            });
        $("#refresh").val(remainingRefresh);
    }

    function sortSkills() {
        var skills = [];
        $("#skill-list").find("li").each(function () {
            var item = {};
            item.skill = $(this).find('.skill_name').val();
            item.level = $(this).find('.skill_level').val();
            skills.push(item);
        });
        skills.sort(function (a, b) {
            return b.level - a.level;
        });
        var row = 0;
        $("#skill-list").find("li").each(function (count, item) {
            $(item).find('.skill_name').val(skills[row].skill);
            $(item).find('.skill_level').val(skills[row].level);
            row++;
        });
        checkSkills();
    }
</script>
<?php $this->end(); ?>