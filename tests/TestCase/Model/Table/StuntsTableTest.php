<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StuntsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StuntsTable Test Case
 */
class StuntsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StuntsTable
     */
    public $Stunts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.stunts',
        'app.skills',
        'app.character_skills',
        'app.dice_rolls',
        'app.created_bies',
        'app.updated_bies',
        'app.character_stunts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Stunts') ? [] : ['className' => StuntsTable::class];
        $this->Stunts = TableRegistry::get('Stunts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Stunts);

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
