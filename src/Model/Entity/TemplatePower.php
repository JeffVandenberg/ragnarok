<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TemplatePower Entity
 *
 * @property int $id
 * @property int $template_id
 * @property int $power_id
 * @property int $power_cost
 *
 * @property \App\Model\Entity\Template $template
 * @property \App\Model\Entity\Power $power
 */
class TemplatePower extends Entity
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
        'template_id' => true,
        'power_id' => true,
        'power_cost' => true,
        'template' => true,
        'power' => true
    ];
}
