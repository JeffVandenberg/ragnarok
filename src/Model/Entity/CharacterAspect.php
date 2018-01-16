<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CharacterAspect Entity
 *
 * @property int $id
 * @property int $character_id
 * @property int $aspect_type_id
 * @property string $aspect_text
 * @property string $description
 * @property int $story_id
 * @property int $assoc_character_id
 *
 * @property \App\Model\Entity\Character $character
 * @property \App\Model\Entity\AspectType $aspect_type
 * @property \App\Model\Entity\Story $story
 */
class CharacterAspect extends Entity
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
        'aspect_type_id' => true,
        'aspect_text' => true,
        'description' => true,
        'story_id' => true,
        'assoc_character_id' => true,
        'character' => true,
        'aspect_type' => true,
        'story' => true
    ];
}
