<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CharacterGmNote Entity
 *
 * @property int $id
 * @property int $character_id
 * @property string $note
 * @property int $created_by_id
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Character $character
 * @property \App\Model\Entity\User $created_by
 */
class CharacterGmNote extends Entity
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
        'note' => true,
        'created_by_id' => true,
        'created' => true,
        'character' => true,
        'created_by' => true
    ];
}
