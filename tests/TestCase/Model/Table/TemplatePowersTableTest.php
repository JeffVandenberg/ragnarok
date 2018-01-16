<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TemplatePowersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TemplatePowersTable Test Case
 */
class TemplatePowersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TemplatePowersTable
     */
    public $TemplatePowers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.template_powers',
        'app.templates',
        'app.created_bies',
        'app.updated_bies',
        'app.characters',
        'app.games',
        'app.character_statuses',
        'app.physical_stress_skills',
        'app.mental_stress_skills',
        'app.social_stress_skills',
        'app.hunger_stress_skills',
        'app.bluebooks',
        'app.character_aspects',
        'app.character_gm_notes',
        'app.character_powers',
        'app.character_skills',
        'app.character_stunts',
        'app.dice_rolls',
        'app.request_characters',
        'app.requests',
        'app.story_characters',
        'app.powers',
        'app.created_by',
        'app.groups',
        'app.groups_users',
        'app.permissions',
        'app.users',
        'app.permissions_users',
        'app.updated_by'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TemplatePowers') ? [] : ['className' => TemplatePowersTable::class];
        $this->TemplatePowers = TableRegistry::get('TemplatePowers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TemplatePowers);

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
