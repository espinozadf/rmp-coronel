<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VistaasignadoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VistaasignadoTable Test Case
 */
class VistaasignadoTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VistaasignadoTable
     */
    public $Vistaasignado;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.vistaasignado',
        'app.licencias',
        'app.tipos_licencia',
        'app.auxiliares',
        'app.ciudades',
        'app.estados',
        'app.arte_pesca',
        'app.recursos',
        'app.unidades',
        'app.descarga_detalles',
        'app.descarga_encabezados',
        'app.movimientos',
        'app.guia_encabezados',
        'app.divisones',
        'app.origen_recintos',
        'app.divisiones',
        'app.areas',
        'app.areas_recursos',
        'app.grupos',
        'app.areas_grupos',
        'app.usuarios',
        'app.grupos_usuarios',
        'app.privilegios',
        'app.grupos_privilegios',
        'app.areas_auxiliares',
        'app.especies',
        'app.especies_recursos',
        'app.areas_especies',
        'app.areas_movimientos',
        'app.naves',
        'app.regimenes',
        'app.naves_unidades',
        'app.armadores',
        'app.representantes',
        'app.zona_operaciones',
        'app.capitanes',
        'app.sindicatos',
        'app.bodegas',
        'app.naves_recursos',
        'app.areas_naves',
        'app.mareas',
        'app.puertos',
        'app.recintos',
        'app.areas_recintos',
        'app.pontones',
        'app.plantas',
        'app.recaladas',
        'app.descargas_abiertas',
        'app.descarga_detalles_camanchaca',
        'app.zonas_pesca',
        'app.macro_zonas',
        'app.operaciones',
        'app.tipo_operaciones',
        'app.macro_zonas_zonas_pesca',
        'app.destinatarios',
        'app.t_c_ss',
        'app.descarga_detalles_unidades',
        'app.guia_detalles',
        'app.guia_detalles_unidades',
        'app.tipo_descargas',
        'app.descargas_industriales',
        'app.descargas_artesanales',
        'app.recaladas_abiertas',
        'app.areas_tipo_descargas',
        'app.destino_recintos',
        'app.camiones',
        'app.transportes',
        'app.areas_camiones',
        'app.choferes',
        'app.controles_calidad',
        'app.tratamientos',
        'app.recursos_unidades',
        'app.unidades_principales',
        'app.licencias_macro_zonas',
        'app.numeraciones',
        'app.licencias_unidades',
        'app.unidades_costo',
        'app.tipo_origen',
        'app.sapdescargas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Vistaasignado') ? [] : ['className' => 'App\Model\Table\VistaasignadoTable'];
        $this->Vistaasignado = TableRegistry::get('Vistaasignado', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Vistaasignado);

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
