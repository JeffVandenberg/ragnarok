<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PowersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PowersTable Test Case
 */
class PowersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PowersTable
     */
    public $Powers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.powers',
        'app.created_bies',
        'app.updated_bies',
        'app.character_powers',
        'app.template_powers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Powers') ? [] : ['className' => PowersTable::class];
        $this->Powers = TableRegistry::get('Powers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Powers);

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
