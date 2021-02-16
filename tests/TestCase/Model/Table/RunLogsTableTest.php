<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RunLogsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RunLogsTable Test Case
 */
class RunLogsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RunLogsTable
     */
    public $RunLogs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.RunLogs',
        'app.Users',
        'app.Dates',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('RunLogs') ? [] : ['className' => RunLogsTable::class];
        $this->RunLogs = TableRegistry::getTableLocator()->get('RunLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RunLogs);

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
