<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TunesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TunesTable Test Case
 */
class TunesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TunesTable
     */
    public $Tunes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tunes',
        'app.artists',
        'app.feelings'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Tunes') ? [] : ['className' => 'App\Model\Table\TunesTable'];
        $this->Tunes = TableRegistry::get('Tunes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Tunes);

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
