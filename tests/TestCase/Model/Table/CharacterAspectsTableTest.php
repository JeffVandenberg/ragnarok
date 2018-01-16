<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CharacterAspectsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CharacterAspectsTable Test Case
 */
class CharacterAspectsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CharacterAspectsTable
     */
    public $CharacterAspects;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.character_aspects',
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
        'app.character_powers',
        'app.physical_stress_skills',
        'app.mental_stress_skills',
        'app.social_stress_skills',
        'app.hunger_stress_skills',
        'app.bluebooks',
        'app.character_gm_notes',
        'app.character_skills',
        'app.character_stunts',
        'app.dice_rolls',
        'app.request_characters',
        'app.requests',
        'app.story_characters',
        'app.aspect_types',
        'app.stories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CharacterAspects') ? [] : ['className' => CharacterAspectsTable::class];
        $this->CharacterAspects = TableRegistry::get('CharacterAspects', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CharacterAspects);

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
