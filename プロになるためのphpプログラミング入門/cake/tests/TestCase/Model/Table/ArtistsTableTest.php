<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ArtistsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ArtistsTable Test Case
 */
class ArtistsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ArtistsTable
     */
    public $Artists;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.artists',
        'app.tunes',
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
        $config = TableRegistry::exists('Artists') ? [] : ['className' => 'App\Model\Table\ArtistsTable'];
        $this->Artists = TableRegistry::get('Artists', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Artists);

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
}
