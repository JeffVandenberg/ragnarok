<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Skill Entity
 *
 * @property int $id
 * @property string $skill_name
 * @property bool $is_official
 *
 * @property \App\Model\Entity\CharacterSkill[] $character_skills
 * @property \App\Model\Entity\DiceRoll[] $dice_rolls
 * @property \App\Model\Entity\Stunt[] $stunts
 */
class Skill extends Entity
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
        'skill_name' => true,
        'is_official' => true,
        'character_skills' => true,
        'dice_rolls' => true,
        'stunts' => true
    ];
}
