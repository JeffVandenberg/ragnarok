<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CharactersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CharactersTable Test Case
 */
class CharactersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CharactersTable
     */
    public $Characters;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.characters',
        'app.games',
        'app.character_statuses',
        'app.templates',
        'app.created_bies',
        'app.updated_bies',
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
        $config = TableRegistry::exists('Characters') ? [] : ['className' => CharactersTable::class];
        $this->Characters = TableRegistry::get('Characters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Characters);

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
