<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TipoOrigenesLicenciaTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TipoOrigenesLicenciaTable Test Case
 */
class TipoOrigenesLicenciaTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TipoOrigenesLicenciaTable
     */
    public $TipoOrigenesLicencia;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tipo_origenes_licencia'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TipoOrigenesLicencia') ? [] : ['className' => 'App\Model\Table\TipoOrigenesLicenciaTable'];
        $this->TipoOrigenesLicencia = TableRegistry::get('TipoOrigenesLicencia', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TipoOrigenesLicencia);

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
