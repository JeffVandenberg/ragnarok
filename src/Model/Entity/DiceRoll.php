<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DiceRoll Entity
 *
 * @property int $id
 * @property int $character_id
 * @property string $action_note
 * @property int $roll_total
 * @property int $modifier
 * @property int $skill_id
 * @property int $skill_level
 * @property int $fate_spent
 * @property string $aspects_tagged
 * @property int $created_by_id
 * @property \Cake\I18n\FrozenTime $created
 * @property bool $is_official
 *
 * @property \App\Model\Entity\Character $character
 * @property \App\Model\Entity\Skill $skill
 * @property \App\Model\Entity\User $created_by
 */
class DiceRoll extends Entity
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
        'action_note' => true,
        'roll_total' => true,
        'modifier' => true,
        'skill_id' => true,
        'skill_level' => true,
        'fate_spent' => true,
        'aspects_tagged' => true,
        'created_by_id' => true,
        'created' => true,
        'is_official' => true,
        'character' => true,
        'skill' => true,
        'created_by' => true
    ];
}
