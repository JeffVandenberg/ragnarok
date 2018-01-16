<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Power Entity
 *
 * @property int $id
 * @property string $power_name
 * @property string $description
 * @property int $cost
 * @property bool $is_official
 * @property bool $is_approved
 * @property int $created_by_id
 * @property \Cake\I18n\FrozenTime $created
 * @property int $updated_by_id
 * @property \Cake\I18n\FrozenTime $updated
 *
 * @property \App\Model\Entity\User $created_by
 * @property \App\Model\Entity\User $updated_by
 * @property \App\Model\Entity\CharacterPower[] $character_powers
 * @property \App\Model\Entity\TemplatePower[] $template_powers
 */
class Power extends Entity
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
        'power_name' => true,
        'description' => true,
        'cost' => true,
        'is_official' => true,
        'is_approved' => true,
        'created_by_id' => true,
        'created' => true,
        'updated_by_id' => true,
        'updated' => true,
        'created_by' => true,
        'updated_by' => true,
        'character_powers' => true,
        'template_powers' => true
    ];
}
