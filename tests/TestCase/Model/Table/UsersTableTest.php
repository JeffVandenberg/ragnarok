<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersTable Test Case
 */
class UsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersTable
     */
    public $Users;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users',
        'app.pinky_acl_users',
        'app.pinky_bookmarks',
        'app.pinky_bots',
        'app.pinky_drafts',
        'app.pinky_forums_access',
        'app.pinky_forums_track',
        'app.pinky_forums_watch',
        'app.pinky_log',
        'app.pinky_login_attempts',
        'app.pinky_moderator_cache',
        'app.pinky_notifications',
        'app.pinky_oa_social_login_usermeta',
        'app.pinky_oauth_accounts',
        'app.pinky_oauth_tokens',
        'app.pinky_privmsgs_folder',
        'app.pinky_privmsgs_rules',
        'app.pinky_privmsgs_to',
        'app.pinky_profile_fields_data',
        'app.pinky_reports',
        'app.pinky_sessions_keys',
        'app.pinky_topics_posted',
        'app.pinky_topics_track',
        'app.pinky_topics_watch',
        'app.pinky_user_group',
        'app.pinky_user_notifications',
        'app.pinky_users',
        'app.pinky_warnings',
        'app.pinky_zebra',
        'app.groups',
        'app.groups_users',
        'app.permissions',
        'app.permissions_users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Users') ? [] : ['className' => UsersTable::class];
        $this->Users = TableRegistry::get('Users', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Users);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
