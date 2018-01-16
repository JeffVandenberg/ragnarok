<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Template Entity
 *
 * @property int $id
 * @property string $template_name
 * @property string $description
 * @property bool $is_official
 * @property bool $is_approved
 * @property int $created_by_id
 * @property \Cake\I18n\FrozenTime $created
 * @property int $updated_by_id
 * @property \Cake\I18n\FrozenTime $updated
 *
 * @property \App\Model\Entity\User $created_by
 * @property \App\Model\Entity\User $updated_by
 * @property \App\Model\Entity\Character[] $characters
 * @property \App\Model\Entity\TemplatePower[] $template_powers
 */
class Template extends Entity
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
        'template_name' => true,
        'description' => true,
        'is_official' => true,
        'is_approved' => true,
        'created_by_id' => true,
        'created' => true,
        'updated_by_id' => true,
        'updated' => true,
        'created_by' => true,
        'updated_by' => true,
        'characters' => true,
        'template_powers' => true
    ];
}
