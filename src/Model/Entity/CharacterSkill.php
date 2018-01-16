<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CharacterSkill Entity
 *
 * @property int $id
 * @property int $character_id
 * @property int $skill_id
 * @property int $skill_level
 *
 * @property \App\Model\Entity\Character $character
 * @property \App\Model\Entity\Skill $skill
 */
class CharacterSkill extends Entity
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
        'character_id' => true,
        'skill_id' => true,
        'skill_level' => true,
        'character' => true,
        'skill' => true
    ];
}
