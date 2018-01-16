<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Permission Entity
 *
 * @property int $id
 * @property string $permission_name
 *
 * @property \App\Model\Entity\User[] $users
 */
class Permission extends Entity
{
    public static $EditDatabase = 1;
    public static $Admin = 2;
    public static $ViewUsers = 3;
    public static $EditUsers = 4;
    public static $GameMaster = 5;

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
        'permission_name' => true,
        'users' => true
    ];
}
