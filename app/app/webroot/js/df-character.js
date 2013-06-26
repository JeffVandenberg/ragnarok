/* Created with JetBrains PhpStorm.
 * User: JeffVandenberg
 * Date: 5/30/13
 * Time: 9:31 PM
 * To change this template use File | Settings | File Templates.
 */

var dfCharacter = {};
dfCharacter.skillPoints = 30;
dfCharacter.powerLevel = 8;
dfCharacter.baseMentalStress = 2;
dfCharacter.basePhysicalStress = 2;
dfCharacter.baseSocialStress = 2;
dfCharacter.calculateStressModifier = function (skillValue) {
    var modifier = 0;
    if ((skillValue >= 1) && (skillValue <= 2)) {
        modifier = 1
    }
    if (skillValue >= 3) {
        modifier = 2
    }
    return modifier;
};
dfCharacter.calculateExtraConsequence = function (skillValue) {
    var modifier = 0;
    if (skillValue > 4) {
        modifier = Math.ceil((skillValue - 4) / 2);
    }
    return modifier;
};

function updateSkills() {
    var mentalStress = dfCharacter.baseMentalStress;
    var physicalStress = dfCharacter.basePhysicalStress;
    var socialStress = dfCharacter.baseSocialStress;
    var extraMentalConsequence = 0;
    var extraPhysicalConsequence = 0;
    var extraSocialConsequence = 0;

    $(".skill-name").each(function (row, item) {
        var skillValue = $(item).parent('div').find('.skill-level').val();

        var physicalStressSkill = $("#CharacterPhysicalStressSkillId").find('option:selected').text();
        var mentalStressSkill = $("#CharacterMentalStressSkillId").find('option:selected').text();
        var socialStressSkill = $("#CharacterSocialStressSkillId").find('option:selected').text();
        if ($(item).val() == mentalStressSkill) {
            mentalStress += dfCharacter.calculateStressModifier(skillValue);
            extraMentalConsequence = dfCharacter.calculateExtraConsequence(skillValue);
        }
        if ($(item).val() == 'Discipline') {

        }
        if ($(item).val() == physicalStressSkill) {
            physicalStress += dfCharacter.calculateStressModifier(skillValue);
            extraPhysicalConsequence = dfCharacter.calculateExtraConsequence(skillValue);
        }
        if ($(item).val() == socialStressSkill) {
            socialStress += dfCharacter.calculateStressModifier(skillValue);
            extraSocialConsequence = dfCharacter.calculateExtraConsequence(skillValue);
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

function UpdateCharacterPowers(powers) {
    for (var i = 0; i < powers.powers.length; i++) {
        var power = powers.powers[i];
    }
}

function clearPowerRow() {
    $(this)
        .closest('div')
        .find('.power-id')
        .val(0);
    $(this)
        .closest('div')
        .find('.refresh-cost')
        .val('0');
    $(this)
        .closest('div')
        .find('.power-name')
        .css('background-color', '')
        .attr('readonly', false)
        .val('')
        .blur();
    checkRefresh();
}

function clearSkillRow() {
    $(this)
        .closest('div')
        .find('.skill-id')
        .val(0);
    $(this)
        .closest('div')
        .find('.skill-level')
        .val('0');
    $(this)
        .closest('div')
        .find('.skill-name')
        .css('background-color', '')
        .attr('readonly', false)
        .val('')
        .blur();
    checkSkills();
}

function clearStuntRow() {
    $(this)
        .closest('div')
        .find('.stunt-id')
        .val(0);
    $(this)
        .closest('div')
        .find('.stunt-cost')
        .val('0');
    $(this)
        .closest('div')
        .find('.stunt-note')
        .val('')
        .blur();
    $(this)
        .closest('div')
        .find('.stunt-name')
        .css('background-color', '')
        .attr('readonly', false)
        .val('')
        .blur();
    checkSkills();
}

$(function () {
    initializeCharacter();
    $(".simple-button").button();

    $("#CharacterTemplateId").change(function () {
        var templateId = $(this).val();
        if (templateId == -1) {
        }
        else {
            $.get('<?php echo $this->Html->url(' / '); ?>templates/listpowers/' + templateId + '.json', null, UpdateCharacterPowers)
        }
    });

    var showSkillAlert = true;
    var selectedSkill;
    $(document)
        .on('focus', '.skill-name:not(.ui-autocomplete-input)', function () {
            $(this).autocomplete({
                source: baseUrl + 'skills/getList.json',
                select: function (e, ui) {
                    selectedSkill = true;
                    $(this).closest('div').find('.skill-name')
                        .val(ui.item.label)
                        .attr('readonly', 'readonly')
                        .css('background-color', '#ddccbb');
                    $(this).closest('div').find('.skill-id')
                        .val(ui.item.value);
                    var deleteImg = $('<img />')
                        .addClass('skill-delete')
                        .addClass('clickable')
                        .attr('src', baseUrl + 'img/ragny_icon_delete.png');
                    $(this).closest('div').append(deleteImg);
                    e.preventDefault();
                },
                response: function () {
                    selectedSkill = false;
                },
                focus: function () {
                    return false;
                },
                change: function () {
                    var skillName = $(this).closest('div').find('.skill-name').val();
                    if (!selectedSkill && (skillName != '') && (skillName != 'Skill Name')) {
                        if (showSkillAlert) {
                            alert('Please select a skill from the list rather than free type.');
                            showSkillAlert = false;
                        }
                        $(this)
                            .closest('div')
                            .find('.skill-name')
                            .val('')
                            .blur();
                        $(this)
                            .closest('div')
                            .find('.skill-id')
                            .val(0);
                    }
                }
            });
            $(this).autocomplete('search', $(this).val());
        });

    var selectedStunt;
    $(document)
        .on('focus', '.stunt-name:not(.ui-autocomplete-input)', function () {
            $(this).autocomplete({
                source: baseUrl + 'stunts/getList.json',
                focus: function () {
                    return false;
                },
                select: function (e, ui) {
                    selectedStunt = true;
                    $(this).closest('div').find('.stunt-name')
                        .val(ui.item.label)
                        .attr('readonly', 'readonly')
                        .css('background-color', '#ddccbb');
                    $(this).closest('div').find('.stunt-id')
                        .val(ui.item.value);
                    $(this).closest('div').find('.stunt-cost')
                        .val(ui.item.Stunt.cost);

                    var deleteImg = $('<img />')
                        .addClass('stunt-delete')
                        .addClass('clickable')
                        .attr('src', baseUrl + 'img/ragny_icon_delete.png');
                    $(this).closest('div').append(deleteImg);

                    e.preventDefault();
                },
                response: function (e, ui) {
                    selectedStunt = false;
                    inStunt = false;
                    for (var i = 0; i < ui.content.length; i++) {
                        var obj = ui.content[i];
                        obj.label = obj.Stunt.stunt_name + ' (' + obj.Skill.skill_name + ')';
                        obj.value = obj.Stunt.id;
                    }
                },
                change: function () {
                    inStunt = true;
                    var row = $(this).closest('div');
                    var stuntName = $(row).find('.stunt-name').val();
                    if ((!selectedStunt) && (stuntName != 'Stunt Name') && (stuntName != '')) {
                        if (confirm('Would you like to create ' + stuntName + '?')) {
                            $("#sheet-subview").load(
                                baseUrl + 'stunts/add?name=' + encodeURIComponent(stuntName),
                                null,
                                function () {
                                    $(this).dialog({
                                        modal: true,
                                        width: 600,
                                        height: 550,
                                        title: 'Add Stunt',
                                        closeOnEscape: false,
                                        open: function (event, ui) {
                                            $(".ui-dialog-titlebar-close")
                                                .hide();
                                        },
                                        buttons: {
                                            Save: function () {
                                                var dialog = this;
                                                var data = $("#sheet-subview").find('form').serializeArray()
                                                $.post(
                                                    baseUrl + 'stunts/add/',
                                                    data,
                                                    function (response) {
                                                        if (response.result == 'ok') {
                                                            $(row).find('.stunt-name')
                                                                .val(response.Stunt.stunt_name)
                                                                .attr('readonly', 'readonly')
                                                                .css('background-color', '#ddccbb');
                                                            $(row).find('.stunt-id').val(response.Stunt.id);

                                                            var deleteImg = $('<img />')
                                                                .addClass('stunt-delete')
                                                                .addClass('clickable')
                                                                .attr('src', baseUrl + 'img/ragny_icon_delete.png');
                                                            $(this).closest('div').append(deleteImg);

                                                            $(dialog).dialog('close');
                                                        }
                                                        else {
                                                            alert(response.message);
                                                        }
                                                    }
                                                );
                                            },
                                            Cancel: function () {
                                                $(row).find('.stunt-name').val('').blur();
                                                $(this).dialog('close');
                                            }}
                                    });
                                }
                            );
                        }
                        else {
                            $(this)
                                .closest('div')
                                .find('.stunt-name')
                                .val('')
                                .blur();
                            $(this).closest('div').find('.stunt-id').val(0);
                        }
                    }
                }
            });
            $(this).autocomplete('search', $(this).val());
        });

    var selectedPower;
    $(document)
        .on('focus', '.power-name:not(.ui-autocomplete-input)', function () {
            $(this).autocomplete({
                source: baseUrl + 'powers/getList.json',
                select: function (e, ui) {
                    selectedPower = true;
                    $(this).closest('div').find('.power-name')
                        .val($.trim(ui.item.label))
                        .attr('readonly', 'readonly')
                        .css('background-color', '#ddccbb');
                    $(this).closest('div').find('.power-id').val(ui.item.value);
                    $(this).closest('div').find('.refresh-cost').val(ui.item.Power.cost);

                    var deleteImg = $('<img />')
                        .addClass('power-delete')
                        .addClass('clickable')
                        .attr('src', baseUrl + 'img/ragny_icon_delete.png');
                    $(this).closest('div').append(deleteImg);
                    checkRefresh();
                    e.preventDefault();
                },
                response: function (e, ui) {
                    selectedPower = false;
                    for (var i = 0; i < ui.content.length; i++) {
                        var obj = ui.content[i];
                        obj.label = $.trim(obj.Power.power_name);
                        obj.value = obj.Power.id;
                    }
                },
                focus: function () {
                    return false;
                },
                change: function () {
                    var powerName = $(this).closest('div').find('.power-name').val();
                    var powerId = $(this).closest('div').find('.power-id').val();
                    if((powerId == '') || (powerId == '0')) {
                        if(($.trim(powerName) != 'Power Name') && ($.trim(powerName) != '')) {
                            alert('Select Powers from the drop down');
                            $(this).closest('div').find('.power-name').val('').blur();
                        }
                    }
                    selectedPower = false;
                }
            });
            $(this).autocomplete('search', $(this).val());
        });

    $("#add-skill").click(function () {
        var list = $("#skill-list");
        var rowNumber = list.find('li').length;
        var newItem = $("<li></li>");
        var newContent = $("<div></div>")
            .addClass('input');
        var characterSkillId = $('<input />')
            .attr('type', 'hidden')
            .attr('name', 'data[Character][' + rowNumber + '][CharacterSkill][id]')
            .attr('id', 'Character' + rowNumber + 'CharacterSkillId');
        var skillId = $('<input />')
            .attr('type', 'hidden')
            .attr('name', 'data[Character][' + rowNumber + '][CharacterSkill][skill_id]')
            .attr('id', 'Character' + rowNumber + 'CharacterSkillSkillId')
            .addClass('skill-id')
            .val(0);
        var skillName = $("<input />")
            .addClass('skill-name')
            .addClass('field-hint')
            .attr('fieldname', 'Skill Name')
            .attr('name', 'data[Character][' + rowNumber + '][CharacterSkill][skill_name]')
            .val('Skill Name')
            .blur();
        var skillLevel = $("<input />")
            .addClass('skill-level')
            .attr('type', 'number')
            .attr('name', 'data[Character][' + rowNumber + '][CharacterSkill][skill_level]')
            .val(0);
        var viewImg = $('<img />')
            .attr('src', baseUrl + 'img/ragny_icon_search.png')
            .addClass('skill-view')
            .addClass('clickable');
        newItem.append(
            newContent
                .append(characterSkillId)
                .append(skillId)
                .append(skillName)
                .append(skillLevel)
                .append(viewImg)
        );
        list.append(newItem);
    });

    $("#add-power").click(function () {
        var list = $("#power-list");
        var rowNumber = list.find('li').length;
        var newItem = $("<li></li>");
        var newContent = $("<div></div>")
            .addClass('input');
        var characterPowerId = $("<input />")
            .attr('type', 'hidden')
            .attr('name', 'data[CharacterPower][' + rowNumber + '][id]')
            .attr('id', 'CharacterPower' + rowNumber + 'Id');
        var powerId = $('<input />')
            .attr('type', 'hidden')
            .attr('name', 'data[CharacterPower][' + rowNumber + '][power_id]')
            .attr('id', 'CharacterPower' + rowNumber + 'PowerId')
            .addClass('power-id')
            .val(0);
        var powerName = $("<input />")
            .addClass('power-name')
            .addClass('field-hint')
            .attr('fieldname', 'Power Name')
            .attr('name', 'data[CharacterPower][' + rowNumber + '][Power][power_name]')
            .attr('id', 'CharacterPower' + rowNumber + 'PowerPowerName');
        var powerNote = $('<input />')
            .addClass('power-note')
            .addClass('field-hint')
            .attr('fieldname', 'Power Note')
            .attr('name', 'data[CharacterPower][' + rowNumber + '][power_note]')
            .attr('id', 'CharacterPower' + rowNumber + 'PowerNote');
        var refreshCost = $("<input />")
            .addClass('refresh-cost')
            .attr('type', 'number')
            .attr('name', 'data[CharacterPower][' + rowNumber + '][refresh_cost]')
            .val(0);
        var viewImg = $('<img />')
            .attr('src', baseUrl + 'img/ragny_icon_search.png')
            .addClass('power-view')
            .addClass('clickable');
        newItem.append(
            newContent
                .append(characterPowerId)
                .append(powerId)
                .append(powerName)
                .append(powerNote)
                .append(refreshCost)
                .append(viewImg)
        );
        list.append(newItem);
        powerName.blur();
        powerNote.blur();
    });

    $("#add-stunt").click(function () {
        var list = $("#stunt-list");
        var rowNumber = list.find('li').length;
        var newItem = $("<li></li>");
        var newContent = $("<div></div>")
            .addClass('input');
        var characterStuntId = $("<input />")
            .attr('type', 'hidden')
            .attr('name', 'data[CharacterStunt][' + rowNumber + '][id]')
            .attr('id', 'CharacterStunt' + rowNumber + 'Id');
        var stuntId = $('<input />')
            .attr('type', 'hidden')
            .attr('name', 'data[CharacterStunt][' + rowNumber + '][stunt_id]')
            .attr('id', 'CharacterStunt' + rowNumber + 'StuntId')
            .addClass('stunt-id')
            .val('0');
        var stuntName = $("<input />")
            .addClass('stunt-name')
            .addClass('field-hint')
            .attr('fieldname', 'Stunt Name')
            .attr('name', 'stunt_name[]')
            .val('Stunt Name')
            .css('color', '#aaaaaa');
        var stuntRules = $("<input />")
            .addClass('stunt-note')
            .addClass('field-hint')
            .attr('fieldname', 'Note')
            .attr('name', 'data[CharacterStunt][' + rowNumber + '][note]')
            .attr('id', 'CharacterStunt' + rowNumber + 'Note')
            .attr('type', 'text')
            .attr('maxlength', 45)
            .val('Note')
            .css('color', '#aaaaaa');
        var cost = $("<input />")
            .addClass('stunt-cost')
            .attr('name', 'data[CharacterStunt][' + rowNumber + '][cost]')
            .attr('id', 'CharacterStunt' + rowNumber + 'Cost')
            .attr('type', 'hidden')
            .val(0);
        newItem.append(
            newContent
                .append(characterStuntId)
                .append(stuntId)
                .append(stuntName)
                .append(stuntRules)
                .append(cost)
        );
        list.append(newItem);
    });

    $("#apply-template").click(function() {
            alert('applying template')
        });

    $("#sort-skills").click(function () {
        sortSkills();
    });

    $("#sort-powers").click(function () {
        var powers = [];
        var list = $('#power-list');
        list.find("li").each(function () {
            var item = {};
            item.name = $(this).find('.power_name').getValue();
            item.cost = $(this).find('.refresh_cost').val();
            powers.push(item);
        });
        powers.sort(function (a, b) {
            if (a.name < b.name) {
                return -1;
            }
            if (b.name < a.name) {
                return 1;
            }
            return 0;
        });
        var row = 0;
        list.find("li").each(function (count, item) {
            $(item).find('.power_name').val(powers[row].name);
            $(item).find('.refresh_cost').val(powers[row].cost);
            row++;
        });
    });

    $("#sort-stunts").click(function () {
        var stunts = [];
        var list = $("#stunt-list");
        list.find("li").each(function () {
            var item = {};
            item.id = $(this).find('.stunt-id').val();
            item.name = $(this).find('.stunt-name').getValue();
            item.note = $(this).find('.stunt-note').getValue();
            item.cost = $(this).find('.stunt-cost').val();
            stunts.push(item);
        });
        stunts.sort(function (a, b) {
            if (a.name < b.name) {
                return -1;
            }
            if (b.name < a.name) {
                return 1;
            }
            return 0;
        });
        var row = 0;
        list.find("li").each(function (count, item) {
            $(item).find('.stunt-name').val(stunts[row].name).blur();
            $(item).find('.stunt-id').val(stunts[row].id);
            $(item).find('.stunt-note').val(stunts[row].note);
            $(item).find('.stunt-cost').val(stunts[row].cost);
            row++;
        });
    });

    $("#CharacterSkillSpread").change(function () {
        // initialize
        $(".skill-level").val(0);
        $(".skill-name").val('Skill Name').css('color', '#aaaaaa');

        // set values
        var skillSpread = $(this).find(":selected").text();
        var row = 0;
        var skillLevel = 1;

        while (skillSpread != '') {
            var slashPosition = skillSpread.lastIndexOf('/');
            var numberOfSkills = skillSpread.substring(slashPosition + 1);
            for (var i = 0; i < numberOfSkills; i++) {
                $("#Character" + row++ + "CharacterSkillSkillLevel").val(skillLevel);
            }
            skillSpread = skillSpread.substring(0, slashPosition);
            skillLevel++;
        }
        sortSkills();
    });

    $(document)
        .on('click', '.skill-view', function () {
            var skillId = $(this).closest('div').find('.skill-id').val();
            if ((skillId == 0) || (skillId == '')) {
                alert('No Skill to display');
            }
            else {
                $("#sheet-subview")
                    .load(
                    baseUrl + 'skills/view/' + skillId,
                    null,
                    function () {
                        $(this).dialog({
                            modal: true,
                            width: 500,
                            height: 400,
                            title: 'View Skill'
                        });
                    }
                );
            }
        });

    $(document)
        .on('click', '.stunt-view', function () {
            var stuntId = $(this).closest('div').find('.stunt-id').val();
            if ((stuntId == 0) || (stuntId == '')) {
                alert('No Stunt to display');
            }
            else {
                $("#sheet-subview")
                    .load(
                    baseUrl + 'stunts/view/' + stuntId,
                    null,
                    function () {
                        $(this).dialog({
                            modal: true,
                            width: 500,
                            height: 400,
                            title: 'View Stunt'
                        });
                    }
                );
            }
        });

    $(document)
        .on('click', '.power-view', function() {
            var powerId = $(this).closest('div').find('.power-id').val();
            if((powerId == 0) || (powerId == '')) {
                alert('No Power to display');
            }
            else {
                $("#sheet-subview")
                    .load(
                        baseUrl + 'powers/view/' + powerId,
                        null,
                        function() {
                            $(this).dialog({
                                modal: true,
                                width: 500,
                                height: 400,
                                title: 'View Power'
                            });
                        }
                    );
            }
        });

    $(document)
        .off('blur', '.skill-level')
        .on('blur', '.skill-level', function () {
            checkSkills();
            updateSkills();
        });

    $(document)
        .off('blur', '.refresh-cost')
        .on('blur', '.refresh-cost', function () {
            checkRefresh();
        });

    $(document)
        .off('click', '.skill-delete')
        .on('click', '.skill-delete', function() {
            var skillName = $(this).closest('div').find('.skill-name').val();
            if(confirm('Are you sure you want to delete ' + skillName + '?')) {
                clearSkillRow.call(this);
                $(this).remove();
            }
        });

    $(document)
        .off('click', '.stunt-delete')
        .on('click', '.stunt-delete', function() {
            var stuntName = $(this).closest('div').find('.stunt-name').val();
            if(confirm('Are you sure you want to delete ' + stuntName + '?')) {
                clearStuntRow.call(this);
                $(this).remove();
            }
        });

    $(document)
        .off('click', '.power-delete')
        .on('click', '.power-delete', function() {
            var powerName = $(this).closest('div').find('.power-name').val();
            if(confirm('Are you sure you want to delete ' + powerName + '?')) {
                clearPowerRow.call(this);
                $(this).remove();
            }
        });
});

function checkSkills() {
    var remainingPoints = dfCharacter.skillPoints;

    var levels = [0, 0, 0, 0, 0, 0, 0, 0];
    $('.skill-level')
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
    $("#skill-points").val(remainingPoints);
}

function checkRefresh() {
    var remainingRefresh = dfCharacter.powerLevel;

    var hasPower = false;
    $('.refresh-cost')
        .each(function (count, item) {
            var powerId = $(item).closest('div').find('.power-id').val();
            if((powerId != '0') && (powerId != '')) {
                hasPower = true;
            }
            if (!isNaN(parseInt($(item).val()))) {
                remainingRefresh += parseInt($(item).val());
            }
        });
    if(!hasPower) {
        $("#CharacterTemplateId").val("1");
        remainingRefresh += 2;
        // set to mortal
        // give mortal bonus
    }
    else {
        // check if mortal
        // remind to change if
        if($("#CharacterTemplateId").val() == '1') {
            alert('No longer a mortal character. Please change template.');
        }
    }
    $("#CharacterMaxFate").val(remainingRefresh);
}

function sortSkills() {
    var skills = [];
    var list = $("#skill-list");
    list.find("li").each(function () {
        var item = {};
        item.id = $(this).find('.skill-id').val();
        item.skill = $(this).find('.skill-name').getValue();
        item.level = $(this).find('.skill-level').val();
        skills.push(item);
    });
    skills.sort(function (a, b) {
        return b.level - a.level;
    });
    var row = 0;
    list.find("li").each(function (count, item) {
        $(item).find('.skill-id').val(skills[row].id);
        $(item).find('.skill-name').val(skills[row].skill).blur();
        $(item).find('.skill-level').val(skills[row].level);
        row++;
    });
    checkSkills();
}
