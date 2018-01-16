<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CharacterPower Entity
 *
 * @property int $id
 * @property int $character_id
 * @property int $power_id
 * @property int $refresh_cost
 * @property string $note
 *
 * @property \App\Model\Entity\Character $character
 * @property \App\Model\Entity\Power $power
 */
class CharacterPower extends Entity
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
        'power_id' => true,
        'refresh_cost' => true,
        'note' => true,
        'character' => true,
        'power' => true
    ];
}
