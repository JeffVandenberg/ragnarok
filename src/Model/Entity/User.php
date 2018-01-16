<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $email_address
 * @property string $password
 * @property string $last_login
 * @property bool $is_active
 *
 * @property \App\Model\Entity\Group[] $groups
 * @property \App\Model\Entity\Permission[] $permissions
 */
class User extends Entity
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
        'user_name' => true,
        'first_name' => true,
        'last_name' => true,
        'email_address' => true,
        'password' => true,
        'last_login' => true,
        'is_active' => true,
        'pinky_acl_users' => true,
        'pinky_bookmarks' => true,
        'pinky_bots' => true,
        'pinky_drafts' => true,
        'pinky_forums_access' => true,
        'pinky_forums_track' => true,
        'pinky_forums_watch' => true,
        'pinky_log' => true,
        'pinky_login_attempts' => true,
        'pinky_moderator_cache' => true,
        'pinky_notifications' => true,
        'pinky_oa_social_login_usermeta' => true,
        'pinky_oauth_accounts' => true,
        'pinky_oauth_tokens' => true,
        'pinky_privmsgs_folder' => true,
        'pinky_privmsgs_rules' => true,
        'pinky_privmsgs_to' => true,
        'pinky_profile_fields_data' => true,
        'pinky_reports' => true,
        'pinky_sessions_keys' => true,
        'pinky_topics_posted' => true,
        'pinky_topics_track' => true,
        'pinky_topics_watch' => true,
        'pinky_user_group' => true,
        'pinky_user_notifications' => true,
        'pinky_users' => true,
        'pinky_warnings' => true,
        'pinky_zebra' => true,
        'groups' => true,
        'permissions' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
