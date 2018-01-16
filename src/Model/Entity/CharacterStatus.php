<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CharacterStatus Entity
 *
 * @property int $id
 * @property string $name
 *
 * @property \App\Model\Entity\Character[] $characters
 */
class CharacterStatus extends Entity
{
    public const New = 1;
    public const Approved = 2;
    public const Retired = 3;
    public const Archived = 4;

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
        'name' => true,
        'characters' => true
    ];
}
