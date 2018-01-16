<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AspectTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AspectTypesTable Test Case
 */
class AspectTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AspectTypesTable
     */
    public $AspectTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.aspect_types',
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
        'app.physical_stress_skill',
        'app.character_skills',
        'app.skills',
        'app.dice_rolls',
        'app.stunts',
        'app.character_stunts',
        'app.mental_stress_skill',
        'app.social_stress_skill',
        'app.hunger_stress_skill',
        'app.bluebooks',
        'app.character_gm_notes',
        'app.created_bies',
        'app.request_characters',
        'app.requests',
        'app.story_characters',
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
        $config = TableRegistry::exists('AspectTypes') ? [] : ['className' => AspectTypesTable::class];
        $this->AspectTypes = TableRegistry::get('AspectTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AspectTypes);

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
