<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CharacterStunt Entity
 *
 * @property int $id
 * @property int $character_id
 * @property int $stunt_id
 * @property string $note
 *
 * @property \App\Model\Entity\Character $character
 * @property \App\Model\Entity\Stunt $stunt
 */
class CharacterStunt extends Entity
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
        'stunt_id' => true,
        'note' => true,
        'character' => true,
        'stunt' => true
    ];
}
