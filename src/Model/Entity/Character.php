<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Character Entity
 *
 * @property int $id
 * @property int $game_id
 * @property int $character_status_id
 * @property string $character_name
 * @property int $template_id
 * @property int $power_level
 * @property int $max_fate
 * @property int $skill_level
 * @property int $current_fate
 * @property string $additional_power_notes
 * @property int $available_significant_milestones
 * @property int $available_major_milestones
 * @property int $created_by_id
 * @property \Cake\I18n\FrozenTime $created
 * @property int $updated_by_id
 * @property \Cake\I18n\FrozenTime $updated
 * @property int $physical_stress_skill_id
 * @property int $mental_stress_skill_id
 * @property int $social_stress_skill_id
 * @property int $hunger_stress_skill_id
 * @property int $physical_stress
 * @property int $mental_stress
 * @property int $social_stress
 * @property int $hunger_stress
 * @property int $additional_physical_consequences
 * @property int $additional_mental_consequences
 * @property int $additional_social_consequences
 * @property int $additional_hunger_consequences
 * @property string $public_information
 * @property string $history
 *
 * @property \App\Model\Entity\Game $game
 * @property \App\Model\Entity\CharacterStatus $character_status
 * @property \App\Model\Entity\Template $template
 * @property \App\Model\Entity\User $created_by
 * @property \App\Model\Entity\User $updated_by
 * @property \App\Model\Entity\Skill $physical_stress_skill
 * @property \App\Model\Entity\Skill $mental_stress_skill
 * @property \App\Model\Entity\Skill $social_stress_skill
 * @property \App\Model\Entity\Skill $hunger_stress_skill
 * @property \App\Model\Entity\Bluebook[] $bluebooks
 * @property \App\Model\Entity\CharacterAspect[] $character_aspects
 * @property \App\Model\Entity\CharacterGmNote[] $character_gm_notes
 * @property \App\Model\Entity\CharacterPower[] $character_powers
 * @property \App\Model\Entity\CharacterSkill[] $character_skills
 * @property \App\Model\Entity\CharacterStunt[] $character_stunts
 * @property \App\Model\Entity\DiceRoll[] $dice_rolls
 * @property \App\Model\Entity\RequestCharacter[] $request_characters
 * @property \App\Model\Entity\Request[] $requests
 * @property \App\Model\Entity\StoryCharacter[] $story_characters
 */
class Character extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'game_id' => true,
        'character_status_id' => true,
        'character_name' => true,
        'template_id' => true,
        'power_level' => true,
        'max_fate' => true,
        'skill_level' => true,
        'current_fate' => true,
        'additional_power_notes' => true,
        'available_significant_milestones' => true,
        'available_major_milestones' => true,
        'created_by_id' => true,
        'created' => true,
        'updated_by_id' => true,
        'updated' => true,
        'physical_stress_skill_id' => true,
        'mental_stress_skill_id' => true,
        'social_stress_skill_id' => true,
        'hunger_stress_skill_id' => true,
        'physical_stress' => true,
        'mental_stress' => true,
        'social_stress' => true,
        'hunger_stress' => true,
        'additional_physical_consequences' => true,
        'additional_mental_consequences' => true,
        'additional_social_consequences' => true,
        'additional_hunger_consequences' => true,
        'public_information' => true,
        'history' => true,
        'game' => true,
        'character_status' => true,
        'template' => true,
        'created_by' => true,
        'updated_by' => true,
        'physical_stress_skill' => true,
        'mental_stress_skill' => true,
        'social_stress_skill' => true,
        'hunger_stress_skill' => true,
        'bluebooks' => true,
        'character_aspects' => true,
        'character_gm_notes' => true,
        'character_powers' => true,
        'character_skills' => true,
        'character_stunts' => true,
        'dice_rolls' => true,
        'request_characters' => true,
        'requests' => true,
        'story_characters' => true
    ];
}
