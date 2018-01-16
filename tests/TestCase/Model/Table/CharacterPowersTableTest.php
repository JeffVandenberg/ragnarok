<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CharacterPowersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CharacterPowersTable Test Case
 */
class CharacterPowersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CharacterPowersTable
     */
    public $CharacterPowers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.character_powers',
        'app.characters',
        'app.games',
        'app.character_statuses',
        'app.templates',
        'app.created_by',
        'app.groups',
        'app.groups_users',
        'app.permissions',
        'app.users',
        'app.permissions_users',
        'app.updated_by',
        'app.template_powers',
        'app.powers',
        'app.physical_stress_skill',
        'app.character_skills',
        'app.dice_rolls',
        'app.stunts',
        'app.skills',
        'app.character_stunts',
        'app.mental_stress_skill',
        'app.social_stress_skill',
        'app.hunger_stress_skill',
        'app.bluebooks',
        'app.character_aspects',
        'app.aspect_types',
        'app.stories',
        'app.character_gm_notes',
        'app.request_characters',
        'app.requests',
        'app.story_characters'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CharacterPowers') ? [] : ['className' => CharacterPowersTable::class];
        $this->CharacterPowers = TableRegistry::get('CharacterPowers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CharacterPowers);

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
